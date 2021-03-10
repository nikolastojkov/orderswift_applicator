<template>
  <div class="container mx-auto">
    <form @submit.prevent="submit" class="form bg-white p-6 my-10 relative">
	<h3 class="text-2xl text-gray-900 font-semibold">Apply at Orderswift</h3>

        <p class="text-gray-600"> Remote Laravel Developer</p>
        <div class="flex space-x-5 mt-3">
            <input required type="text" v-model="form.first_name" name="first_name" id="first_name" placeholder="First Name *" class="border p-2  w-1/2">
            <input required type="text" v-model="form.last_name" name="last_name" id="last_name" placeholder="Last Name *" class="border p-2 w-1/2">
        </div>
	<div class="flex space-x-5 mt-3">
            <input required type="text" v-model="form.email" name="email" id="email" placeholder="Email *" class="border p-2  w-1/2">
            <input required type="text" v-model="form.country" name="country" id="country" placeholder="Country * (In ISO-3166-1 format)" class="border p-2 w-1/2">
        </div>
	<div class="flex space-x-5 mt-3">
            <input type="text" v-model="form.github" name="github" id="github" placeholder="Github Username" class="border p-2  w-1/2">
            <input required type="text" v-model="form.cv_url" name="cv_url" id="cv_url" placeholder="CV URL *" class="border p-2 w-1/2">
        </div>

        <textarea v-model="form.introduction" name="introduction" id="introduction" cols="10" rows="3" placeholder="A short message to introduce yourself. Feel free to tell us about your experience or any projects you've worked on. We will view this internally with Markdown parsing." class="border p-2 mt-3 w-full"></textarea>

        <input type="submit" value="Submit" class="w-full mt-6 bg-blue-600 hover:bg-blue-500 text-white font-semibold p-3">
     </form>
  </div>
</template>
<script>
const default_layout = "default";
import axios from 'axios';

export default {
  computed: {},
  data() {
    return {
      form: {},
      success: false,
      loaded: true,
    }
  },
  methods: {
    submit() {
      if (this.loaded) {
        this.loaded = false;
        this.success = false;
        this.errors = {};
        axios.post('/apply', this.form).then(response => {
          this.form = {}; //Clear input fields.
          this.loaded = true;
          this.success = true;
	  if (response.data.status === true) {
	    console.log('applied successfully, good job');
	  } else {
	    console.log(response.data);
	  }
        }).catch(error => {
          this.loaded = true;
          if (error.response.status === 422) {
            this.errors = error.response.data.errors || {};
          }
        });
      }
    },
  },
};
</script>
