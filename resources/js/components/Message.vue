<template>
  <div class="box-message">
      <h3 class="h3"> <i> Inviaci in messaggio </i> </h3>
      <form class="form-group" method="POST" @submit.prevent="sendForm">
        <div>
          <label for="guest_name">Nome:*</label>
          <input v-model="name" id="guest_name"  class="form-control" type="text" placeholder="Inserisci il tuo nome" name="guest_name"
          :class="{ 'is-invalid' : errors.guest_name }">
          <small class="text-danger" v-for="err_name, index in errors.guest_name" :key="`err-name${index}`">{{err_name}}</small>
        </div>

        <div>
          <label for="guest_mail">E-mail:*</label>
          <input v-model="mail" id="guest_mail" class="form-control" type="text" placeholder="Inserisci la tua Mail" name="guest_mail"
          :class="{ 'is-invalid' : errors.guest_mail }">
          <small class="text-danger" v-for="err_mail, index in errors.guest_mail" :key="`err-mail${index}`">{{err_mail}}</small>
        </div>

        <div>
          <label for="content">Message:*</label>
          <textarea v-model="content" id="content" class="form-control" cols="30" rows="10" placeholder="Scrivi il tuo messaggio" name="content" :class="{ 'is-invalid' : errors.content }"></textarea>
          <small class="text-danger" v-for="err_content, index in errors.content" :key="`err-content${index}`">{{err_content}}</small>
        </div>
        <button class="bnb-btn bnb-btn-brand bnb-btn-resp">INVIA</button>
      </form>
  </div>
</template>

<script>
export default {
    name: 'Message',
    props: ['house_id'],
    data(){
      return{
        name:'',
        mail:'',
        content:'',
        errors: {}
      }
    },
    methods: {
      sendForm: function(){
        //axios.post api/messages
        axios.post('http://127.0.0.1:8000/api/messages', {
          house_id: this.house_id,
          guest_name : this.name,
          guest_mail: this.mail,
          content: this.content
        }).then((result) => {
          console.log(result)//ok house_id;
          console.log(result.data);
          if(result.data.errors){
            this.errors = result.data.errors
          }

        }).catch((err) => {
          console.log(err);
        });
      }
    }
}
</script>

<style lang="scss">
@import '../../sass/partials/variables.scss';

  .box-message {
    padding: 16px 32px;
    border-radius: 5px;
    box-shadow: 0 0 3px 0 rgba($brand, 0.2);
    border: 1px solid rgba($black, 0.1);
    form {
      label{
        font-size: 13px;
        margin-bottom: 4px;
      }
      input::placeholder{
        font-size: 14px;
      }
      & > div{
        margin-bottom: 16px;
      }
    }
  }
</style>