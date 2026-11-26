<template>
  <div>
    <form @submit.prevent="filterResults">
      <div class="flex flex-wrap -mx-2.5">
        <div class="w-full lg:w-1/2 xl:w-1/3 2xl:w-1/4 mb-3 px-2.5">
          <label class="mb-1">Email Type</label>
          <select v-model="selectedEmailSetting" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" @change="updateEditorContent">
            <option value="select">Select</option>
            <option value="week1">One week after demo</option>
            <option value="week2">Two weeks after demo</option>
            <option value="week3">Three weeks after demo</option>
            <option value="week4">Four weeks after demo</option>
          </select>
        </div>
      </div>
      <br/>
        <div class="">
          <label for="">Email Subject</label>
          <input v-if="selectedEmailSetting == 'select'" v-model="EmailSubject" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" type="text" />
          <input v-if="selectedEmailSetting == 'week1'" v-model="EmailSubject" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" type="text" />
          <input v-if="selectedEmailSetting == 'week2'" v-model="EmailSubject" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" type="text" />
          <input v-if="selectedEmailSetting == 'week3'" v-model="EmailSubject" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" type="text" />
          <input v-if="selectedEmailSetting == 'week4'" v-model="EmailSubject" class="focus:border-lbrwnclr outline-0 border border-neutral-400 h-7 px-2.5 rounded bg-neutral-100 w-full form-control" type="text" />
        </div>
        <br/>
    </form>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <label for="">Email Content</label>
          <div ref="editor" contenteditable="true" class="form-control" style="height: 300px;" @input="captureEditorContent"></div>
        </div>
      </div>
      <div class="dynamic-tags">
            <h4>Dynamic tags: </h4>
            <span @click="copyTag('{First_Name}')">{First_Name}</span>
            <span @click="copyTag('{Last_Name}')">{Last_Name}</span>
            <span @click="copyTag('{User_Email}')">{User_Email}</span>
        </div>
      <div class="row mt-3">
        <div class="col-lg-12">
          <button class="save-button" @click="saveEditorContent">Save</button>
        </div>
      </div>
    </div>
    <div class="mxi-loader-wrap backdrop-blur-sm fixed w-full h-full top-0 left-0" v-show="viewLoader">
      <img :src="url + '/images/com-loader.gif'" alt="loader" class="loader-img top-[50%] left-[50%] absolute -translate-y-[50%] -translate-x-[50%]">
    </div>
  </div>
</template>

<script>
import { onMounted, ref } from 'vue';
import Quill from 'quill';
import 'quill/dist/quill.snow.css'; // Import Quill's Snow theme CSS

export default {
  data() {
    return {
        url: process.env.MIX_API_URL,
        viewLoader: false,
        selectedEmailSetting: 'select',
        EmailSubject: ''
      }
    },
  name: 'WysiwygEditor',
  methods: {
    copyTag(tag) {
      const el = document.createElement('textarea');
      el.value = tag;
      document.body.appendChild(el);
      el.select();
      document.execCommand('copy');
      document.body.removeChild(el);
      alert("'" + tag + "' copied to clipboard!");
    }
  },
  setup() {
    const editor = ref(null);
    const viewLoader = ref(false); // Define viewLoader using ref

    let quill = null;
    const siteurl = process.env.MIX_API_URL;
    const selectedEmailSetting = ref('select'); // Separate variable to store selected email setting
    const EmailSubject = ref('');
    const editorContents = {
      week1: '',
      week2: '',
      week3: '',
      week4: ''
    };

    const capturedContent = ref('');
    //capturedContent.value = defaultContent;

    onMounted(() => {
      // Initialize Quill editor
      quill = new Quill(editor.value, {
        theme: 'snow',
      });
      // Initially set editor content
      updateEditorContent();
    });

    const updateEditorContent = () => {
      const content = editorContents[selectedEmailSetting.value];
      quill.root.innerHTML = content;
      EmailSubject.value = '';
      if(selectedEmailSetting.value != 'select')
      {
        viewLoader.value = true;
        axios.post(siteurl + '/admin/demoinquiries/getemailcontent', {week:selectedEmailSetting.value}).then((response) => { 
          if( response.data.success ) {
              if(response.data.subject.option_value != '')
              {
                EmailSubject.value = response.data.subject.option_value;
              }

              if(response.data.data.option_value != '')
              {
                quill.root.innerHTML = response.data.data.option_value;
              }
              
              //showSuccessMessage(response.data.message); 
              viewLoader.value = false;
              
          } else {
              //showErrorMessage("Something went wrong!!");
              viewLoader.value = false;
          }
        }).catch((error) => {
          viewLoader.value = false;
        });
      }
      else
      {
        quill.root.innerHTML = '';
      }
    };

    const captureEditorContent = () => {
      capturedContent.value = quill.root.innerHTML;
    };

    const saveEditorContent = () => {
      // Retrieve the content of the editor
      const editorContent = quill.root.innerHTML;
      const selectedWeek = selectedEmailSetting.value;
      const emailSubjectValue = EmailSubject.value;
      if(selectedWeek == 'select')
      {
        showErrorMessage('Please select email type.');
        return;
      }
      if(selectedWeek != 'select')
      {
      
        if(emailSubjectValue == '')
        {
          showErrorMessage('Please entry subject.');
          return;
        }

        if (editorContent == '<p><br></p>')
        {
          showErrorMessage('Please enter content.');
          return;
        }
        
        viewLoader.value = true;
        if(selectedWeek != '' && emailSubjectValue != '' && editorContent != '<p><br></p>')
        {
          axios.post(siteurl + '/admin/demoinquiries/emailcontent', {content:editorContent, week:selectedWeek, subject:emailSubjectValue}).then((response) => { 
            if( response.data.success ) {
                showSuccessMessage(response.data.data.msg);
                viewLoader.value = false;
                // Reload the page after 3 seconds
              setTimeout(() => {
                  window.location.reload();
              }, 3000);
            } 
            else 
            {
                showErrorMessage("Something went wrong!!");
                viewLoader.value = false;
            } 
          }).catch((error) => {
            viewLoader.value = false;
          });
        }
      }
    };

    return { editor, selectedEmailSetting, updateEditorContent, saveEditorContent, capturedContent, viewLoader, EmailSubject };
  }
};
</script>

<style scoped>
/* Add custom styles for the editor container if needed */
.save-button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 8px;
}

.save-button:hover {
  background-color: #45a049; /* Darker green */
}
.dynamic-tags {
    margin-top: 10px;
    width: 100%;
    max-width: 1024px;
}
.dynamic-tags {
    background-color: #e5e5e5;
    border: solid 1px #c4c4c4;
    padding: 10px;
    border-radius: 3px;
    color: #000;
    user-select: none;
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    align-items: center;
}
.dynamic-tags span {
    background-color: #ffffff8f;
    border: solid 1px #0e418161;
    transition: all 0.3s;
    border-radius: 3px;
    padding: 5px 5px;
    /*cursor: move;*/
    margin-right: 5px;
}
/*
.dynamic-tags span:hover {
    user-select: all;
}
*/
</style>
