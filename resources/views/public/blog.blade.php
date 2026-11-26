@extends('layouts.public')
@push('head')
@if( $totalPages == 1 )
<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Article",
      "url": "{{ url()->current() }}",
      "name": "{{ $title ?? 'ComPackage' }}",
      "description": "{{ $description ?? 'ComPackage is a total compensation statement software to show the true value of employee benefits.' }}",
      "inLanguage": "en"
    }
</script>
@else
<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BlogPosting",
      "url": "{{ url()->current() }}",
      "name": "{{ $title ?? 'ComPackage' }}",
      "description": "{{ $description ?? 'ComPackage is a total compensation statement software to show the true value of employee benefits.' }}",
      "inLanguage": "en"
    }
</script>
@endif
@endpush
@section('content')
<div class="container mx-auto px-3.5 dws">
    <div class="row flex flex-wrap">
        <div class="w-full md:w-[60%] lg:w-[70%]">
            <div class="bg-white h-full py-5 px-5 lg:pt-8 lg:px-11 lg:pb-10">
                <posts  slug="{{ $slug }}" search_query="{{ $search_query }}" :posts="{{ json_encode($posts) }}" :pagination="{{ json_encode(['current_page' => (int) $page,'last_page' => (int) $totalPages]) }}"></posts>
            </div>
        </div>
        <div class="w-full md:w-[40%] lg:w-[30%] py-5 px-5 lg:pt-20 lg:pb-5 lg:px-8 bg-bgbrwn">
            <public-sidebar pcurrent_route="{{ url()->current() }}"></public-sidebar>
            <recent></recent>
            <search></search>
            <categories></categories>
            <archives :archive_options="{{json_encode($archive_dropdown)}}"></archives>
            <h3 class="widgettitle text-white text-lg font-bold border-b border-[#7e7373] py-4 mb-4 font-[Roboto_Condensed,Arial,sans-serif]">Subscribe to our Blog</h3>
            <div id="mc_embed_shell">
                <link href="//cdn-images.mailchimp.com/embedcode/classic-061523.css" rel="stylesheet" type="text/css">
                <div id="mc_embed_signup">
                    <form action="https://compackage.us17.list-manage.com/subscribe/post?u=d88d3be38b92862af326bc240&amp;id=151310af6e&amp;f_id=0068d2e3f0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" style="margin: 0 !important;">
                        <div id="mc_embed_signup_scroll">
                            <div class="mc-field-group">
                                <label for="mce-EMAIL" style="line-height: normal; color: #fff;">Email Address <span class="asterisk">*</span></label>
                                <input style="padding: 4px 0;" type="email" name="EMAIL" class="required email" id="mce-EMAIL" required="" value=""></div>
                            <div id="mce-responses" class="clear">
                                <div class="response" id="mce-error-response" style="display: none;"></div>
                                <div class="response" id="mce-success-response" style="display: none;"></div>
                            </div>
                            <div aria-hidden="true" style="position: absolute; left: -5000px;"><input type="text" name="b_d88d3be38b92862af326bc240_151310af6e" tabindex="-1" value=""></div>
                            <div class="clear"><input style='background: #a1d167; background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2ExZDE2NyIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiM3NWE1M2IiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+); background: linear-gradient(to bottom, #a1d167 0%, #75a53b 100%); color: #fff; font-family: "Roboto Condensed"; font-size: 18px; font-weight: 800;' type="submit" name="subscribe" id="mc-embedded-subscribe" class="button" value="Subscribe"></div>
                        </div>
                    </form>
                </div>
                <script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"></script>
                <script type="text/javascript">(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='BIRTHDAY';ftypes[3]='birthday';fnames[4]='MMERGE4';ftypes[4]='text';fnames[5]='MMERGE5';ftypes[5]='text';fnames[6]='MMERGE6';ftypes[6]='text';fnames[7]='MMERGE7';ftypes[7]='text';fnames[8]='MMERGE8';ftypes[8]='text';fnames[9]='MMERGE9';ftypes[9]='text';fnames[10]='MMERGE10';ftypes[10]='text';fnames[11]='MMERGE11';ftypes[11]='text';fnames[12]='MMERGE12';ftypes[12]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
            </div>
        </div>
    </div>
</div>
@endsection