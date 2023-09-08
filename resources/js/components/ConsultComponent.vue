<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card border-dark mb-3" style="box-shadow: 5px 5px 5px black;" >

          <div class="card-header">Consultar folio</div>

          <div class="card-body">
            <div class="mb-3">
              <label for="folioInput" class="form-label">Folio:</label>
              <input
                v-model="folio"
                @input="validateInput"
                type="text"
                class="form-control"
                id="folioInput"
                placeholder="Ingresa el folio"
                style="border: 1px solid #000;"
              />
            </div>

            <div class="col-auto">
              <button @click="sendRequest" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">CONSULTAR</button>
            </div>


          </div>
        </div>
      </div>
    </div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <p v-if="successMessage">Respuesta correcta</p>
            <p v-if="errorMessage">{{ errorMessage }}</p>
                 <p v-if="countdown > 0">{{ countdown }} segundos restantes.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
      


  </div>
</template>

<script>

import CryptoJS from 'crypto-js';
export default {
  data() {
    return {
      folio: "",
      showModal: false,
      successMessage: "",
      errorMessage: "",
      countdown: 300, // 5 minutos en segundos
    };
  },
  methods: {
    encryptJSON(jsonData) {
     
    },
    encryptJSON2(jsonData, encryptionKey) {
      const jsonString = JSON.stringify(jsonData);

      //Tengo que parsear a WordArray para que se pueda concatenar
     const key = CryptoJS.enc.Utf8.parse(encryptionKey);
     const iv = CryptoJS.enc.Utf8.parse(encryptionKey);

      // Realiza el cifrado AES/CBC con PKCS5Padding
      const ciphertext = CryptoJS.AES.encrypt(jsonString, key, {
        iv: iv,
        mode: CryptoJS.mode.CBC,
        padding: CryptoJS.pad.Pkcs7,
        keySize: 256 / 8, 
      });

      // Combina el IV con el texto cifrado y conviértelo a Base64 seguro
      const combined = iv.concat(ciphertext.ciphertext);
      const base64Result = CryptoJS.enc.Base64.stringify(combined);

      return base64Result;
    },

    validateInput() {
     
      this.folio = this.folio.replace(/\D/g, "");
    },
    sendRequest() {
      this.showModal = true;
      this.successMessage = "Respuesta correcta";

      const jsonData = {
           "clienteUnico":{
              "idPais":1,
              "idCanal":1,
              "idSucursal":100,
              "folio":this.folio
           },
           "numeroTelefono":"4878725518",
           "idCampana":172,
           "numeroEmpleado":"800046",
           "token":"Cobranza2022",
           "idOrigen":2,
           "idDespacho":1,
           "fecha":"19/12/2022 13:20:00"
        }
        ;

        const encryptionKey = '192cY7vUQbodWq4q';

         const encryptedData = this.encryptJSON2(jsonData, '192cY7vUQbodWq4q');
  

      axios
        .get(`https://cll.apps.cbz.baz.cloud:8444/regional/front-gestiones/index.html#/front-cobranza/credimax/${this.folio}`)
        .then((response) => {
          if (response.data === "correcto") {
            this.showModal = true;
            this.successMessage = "Respuesta correcta";
            this.startCountdown();
          } else {
            this.showModal = true;
            this.errorMessage = "Error en la respuesta";
          }
        })
        .catch((error) => {
          this.showModal = true;
          this.errorMessage = "Error en la solicitud";
        });
    },
    startCountdown() {
      const timer = setInterval(() => {
        this.countdown--;
        if (this.countdown === 0) {
          clearInterval(timer);
          this.showModal = false;
        }
      }, 1000);
    },
  },
};
</script>

<style scoped>

</style>






