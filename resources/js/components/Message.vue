<template>
  <div class="box-message user-form">
      <h3 class="h3"> <i> Contatta l'host </i> </h3>
      <div class="alert alert-success" v-show="success">
        <h5 class="h5">Messaggio inviato correttamente</h5>
      </div>
      <form class="form-group bnb-form" method="POST" @submit.prevent="sendForm" >
        <div class="input-form mt-2 w-100">
            <div class="label w-100">
                <label for="guest_name">Nome:*</label>
                <input v-model="name" id="guest_name"  class="w-100" type="text" name="guest_name"
                :class="{ 'is-invalid' : errors.guest_name }">
            </div>
        </div>
        <div class="input-form mt-2 w-100">
            <div class="label w-100">
                <label for="guest_mail">E-mail:*</label>
                <input v-model="email" id="guest_email" class="w-100" type="text" name="guest_email"
                :class="{ 'is-invalid' : errors.guest_email }">
        </div>
        </div>

        <div class="input-form mt-2 w-100">
            <div class="label w-100">
                <label for="content">Message:*</label>
                <textarea v-model="content" id="content" class="form-control" cols="30" rows="10" name="content" :class="{ 'is-invalid' : errors.content }"></textarea>
            </div>
        </div>
        
        <button class="bnb-btn bnb-btn-brand bnb-btn-resp" type="submit" :disabled="sending">
          {{ sending ? 'Invio in corso' : 'INVIA' }}
        </button>
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
        email:'',
        content:'',
        errors: {},
        success: false,
        sending: false,
      }
    },
    methods: {
      sendForm: function(){
        //dati inviati pulsante bloccato
        this.sending = true;
        //axios.post api/messages
        axios.post('http://127.0.0.1:8000/api/messages', {
          house_id: this.house_id,
          guest_name : this.name,
          guest_email: this.email,
          content: this.content
        }).then((result) => {
          //dati inviati pulsante sbloccato
          this.sending = false;
          if(result.data.errors){
            //errore in validazione
            this.errors = result.data.errors;
          } else {
            //dati inviati 
            this.errors = {};
            this.name = '',
            this.email = '',
            this.content = '',
            this.success = true
          }

        }).catch((err) => {
          console.log(err);
        });
      },
      getMails(){
        if (this.user == null) {
          this.email = ''
          this.name = ''
        } else {
          this.email = this.user.email
          this.name = `${this.user.first_name} ${this.user.last_name}`
        }
      }
    },
    mounted() {
      this.getMails()
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
    background-color: $white;

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
      //from luca
      ul {
      width: 30%;
      position: absolute;
      top: 65px;
      left: 0;
      list-style: none;
      padding: 0;
      border: 1px solid rgba($gray-1, 0.3);
      border-radius: 12px;
      overflow: hidden;
      background-color: $white;

      li {
          padding: 5px 10px;
          cursor: pointer;

          &:hover,
          &.active {
              background-color: rgba($gray-1, 0.1);
          }
        }
      }
    }
  }
</style>