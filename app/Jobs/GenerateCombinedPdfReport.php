<?php

namespace App\Jobs;

use App\Models\Employee;
use App\Models\PdfJob;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use setasign\Fpdi\Fpdi;
use App\Http\Controllers\BenefitsController;
use App\Models\CustomCategory;

class GenerateCombinedPdfReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $timeout = 7200;
    public $tries = 1;

    protected $jobId;
    protected $employeeIds;
    protected $userId;
    protected $excludeEmp;

    public function __construct($jobId, $employeeIds, $userId, $excludeEmp = false)
    {
        $this->jobId = $jobId;
        $this->employeeIds = $employeeIds;
        $this->userId = $userId;
        $this->excludeEmp = $excludeEmp;
    }

    public function handle()
    {
        $pdfJob = PdfJob::where('job_id', $this->jobId)->first();
        
        if (!$pdfJob) {
            Log::error("PDF Job not found: {$this->jobId}");
            return;
        }

        // CHECK IF JOB WAS CANCELLED
        if ($pdfJob->status === 'cancelled') {
            Log::info("Job {$this->jobId} was cancelled by user - exiting gracefully");
            return; // Exit without throwing exception (won't show as FAIL)
        }

        try {
            $pdfJob->update(['status' => 'processing']);

            Log::info("Starting combined PDF generation for {$this->jobId}");

            ini_set('max_execution_time', 7200);
            ini_set('memory_limit', '2048M');

            $tempPdfs = [];
            $tempDir = storage_path('app/temp/pdf_generation/' . $this->jobId);
            
            if (!file_exists($tempDir)) {
                mkdir($tempDir, 0755, true);
            }

            // Generate individual PDFs
            foreach ($this->employeeIds as $index => $employeeId) {
                try {
                    // Check if cancelled during processing
                    $pdfJob->refresh();
                    if ($pdfJob->status === 'cancelled') {
                        Log::info("Job cancelled during processing");
                        return;
                    }
                    Log::info("Generating PDF for employee {$employeeId}");
                    
                    $pdfContent = $this->generateSingleEmployeePdf($employeeId, $this->excludeEmp);
                    
                    if ($pdfContent && strlen($pdfContent) > 1000) {
                        $tempPath = $tempDir . '/employee_' . $employeeId . '.pdf';
                        file_put_contents($tempPath, $pdfContent);
                        $tempPdfs[] = $tempPath;
                        
                        $pdfJob->update(['processed_employees' => $index + 1]);
                        Log::info("PDF generated successfully");
                    }
                    
                } catch (\Exception $e) {
                    Log::error("Failed to generate PDF for employee {$employeeId}: " . $e->getMessage());
                }
            }

            if (empty($tempPdfs)) {
                throw new \Exception("No PDFs were generated successfully");
            }

            Log::info("Merging " . count($tempPdfs) . " PDFs");

            // Merge all PDFs
            $mergedPdf = new Fpdi();
            $mergedPdf->SetCompression(true);
            foreach ($tempPdfs as $index => $tempPath) {
                try {
                    $mergedPdf->setSourceFile($tempPath);
                    $templateId = $mergedPdf->importPage(1);
                    $size = $mergedPdf->getTemplateSize($templateId);
                    
                    $mergedPdf->AddPage(
                        $size['orientation'], 
                        [$size['width'], $size['height']]
                    );
                    $mergedPdf->useTemplate($templateId);
                    
                } catch (\Exception $e) {
                    Log::error("Failed to merge PDF {$tempPath}: " . $e->getMessage());
                    continue;
                }
            }

            Log::info("Merge complete");

            // Save final combined PDF
            $finalFilename = 'COMPackage-Combined-Report-' . date('Y-m-d-His') . '.pdf';
            $finalPath = 'combined-reports/' . $finalFilename;

            Storage::disk('public')->put($finalPath, $mergedPdf->Output('S'));
            
            Log::info("Combined PDF saved to {$finalPath}");

            // Clean up temp files
            foreach ($tempPdfs as $tempPath) {
                @unlink($tempPath);
            }
            @rmdir($tempDir);

            // Update job as completed
            $pdfJob->update([
                'status' => 'completed',
                'file_path' => $finalPath,
                'processed_employees' => count($this->employeeIds)
            ]);

            Log::info("Job completed successfully");

        } catch (\Exception $e) {
            Log::error("Job failed: " . $e->getMessage());
            
            $pdfJob->update([
                'status' => 'failed',
                'error_message' => substr($e->getMessage(), 0, 500)
            ]);
        }
    }

    private function generateSingleEmployeePdf($employeeId, $excludeEmp)
    {
        $employee = Employee::with('company')->find($employeeId);
        
        if (!$employee || !$employee->company) {
            throw new \Exception("Employee or company not found");
        }

        // Call the controller method that returns DATA (not PDF)
        $controller = new \App\Http\Controllers\PDFReportController();
        $excludeStr = ($excludeEmp === true || $excludeEmp === 'true' || $excludeEmp === 1) ? '1' : '0';
        
        // This method returns the data array with all variables the view needs
        $data = $controller->_individual_pdf_report_combined_pdf(
            $employee->company,
            $employee,
            'print',
            $excludeStr
        );
        
        if (empty($data)) {
            throw new \Exception("No data returned from controller");
        }
        
        // Generate PDF using the data
        $pdf = PDF::loadView('reports.pdf', $data);
        
        $customPaper = array(0,0,614,800);
        $pdf->set_paper($customPaper);
        
        // Get PDF content
        $pdfContent = $pdf->output();
        
        if (empty($pdfContent) || strlen($pdfContent) < 1000) {
            throw new \Exception("PDF content too small");
        }
        
        Log::info("PDF generated, size: " . strlen($pdfContent) . " bytes");
        
        return $pdfContent;
    }
}
