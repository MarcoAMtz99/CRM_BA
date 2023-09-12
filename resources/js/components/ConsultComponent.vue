<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card border-dark mb-3" style="box-shadow: 5px 5px 5px black;" >

          <div class="card-header">Consultar folio</div>

          <div class="card-body">
            <div class="mb-3">
              <label for="folioInput" class="form-label" :class="{ 'text-danger': errorFolio }">
                Folio:
                <span v-if="errorFolio">No puede estar vacío y debe ser mayor que 0.</span>
              </label>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content border-dark" style="box-shadow: 10px 5px 5px black;">
      <div class="modal-header border-dark">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Consultar folio</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <p v-if="successMessage">{{successMessage}} </p>
            <p v-if="errorMessage">{{ errorMessage }}</p>
            <div v-if="error !== true">
                
            </div>
            <div v-else>
                <div class="row">
                    <div class="col-12">
                  <a :href="url" target="_blank" class="btn btn-primary btn-block" style="width: 100%;" >Abrir link</a>
                        
                    </div>
                </div>
             <p v-if="countdown > 0">{{ countdown }} segundos restantes.</p>
            </div>
           
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div> -->
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
      successMessage: false,
      errorMessage: "",
      url:"",
      error:false,
      errorFolio: false, 
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

      const ciphertext = CryptoJS.AES.encrypt(jsonString, key, {
        iv: iv,
        mode: CryptoJS.mode.CBC,
        padding: CryptoJS.pad.Pkcs7,
        keySize: 256 / 8, 
      });

      const combined = iv.concat(ciphertext.ciphertext);
      const base64Result = CryptoJS.enc.Base64.stringify(combined);

      return base64Result;
    },

    validateInput() {
     
      this.folio = this.folio.replace(/\D/g, "");

     if (this.folio.trim() === "" || parseInt(this.folio) <= 0) {
          this.errorFolio = true; 
          return false; 
        } else {
          this.errorFolio = false; 
          return true; 
        }
    },
    sendRequest() {

      const isValid = this.validateInput();
      if(isValid === false){
        this.errorMessage = "No puedes consultar un folio vacio";

        return false;
      }else{

      this.showModal = true;
      this.countdown=300;


      // const jsonData = {
      //   "clienteUnico": {
      //     "idPais": 1,
      //     "idCanal": 1,
      //     "idSucursal": 100,
      //     "folio": this.folio
      //   },
      //   "numeroTelefono": "4878725518",
      //   "idCampana": 172,
      //   "numeroEmpleado": "800046",
      //   "token": "Cobranza2022",
      //   "idOrigen": 2,
      //   "idDespacho": 1,
      //   "fecha": "11/09/2023 13:20:00"
      // };
      const Data = {
          "folio": this.folio
      };


      axios
        .post('/generate-link', { Data }) 
        .then((response) => {
            console.log(response.data);

          if (response.data.status === true) {
            this.showModal = true;
            this.error = true;
            this.url = response.data.cipherText;
            this.successMessage = "Link generado con exito, da click en el boton para visualizar en una nueva ventana la informacion";
            this.errorMessage = "";
            this.startCountdown();
          } else {
            this.showModal = true;
            this.successMessage = "";
            this.errorMessage = "Error en la respuesta";
          }
        })
        .catch((error) => {
          this.showModal = true;
          console.log(error);
          this.errorMessage = "Error en la solicitud";
        });
      }



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






