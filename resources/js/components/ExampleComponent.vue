<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Folio Component</div>

                    <div class="card-body">
                       <div class="mb-3">
                          <label for="folioInput" class="form-label">Folio:</label>
                          <input
                            v-model="folio"
                            @input="validateInput"
                            type="text"
                            class=""
                            id="folioInput"
                            placeholder="Ingresa el folio"
                            style="border: 1px solid #000;"
                          />
                        </div>

                        <div class="col-auto">
                          <button @click="sendRequest" class="" data-bs-toggle="modal" data-bs-target="#exampleModal">CONSULTAR</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Peticion Component</div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-6">

                                     <div class="mb-3">
                          <label for="folioInput" class="form-label">Folio:</label>
                          <input
                            v-model="folio2"
                            @input="validateInput"
                            type="text"
                            class=""
                            id="folioInput"
                            placeholder="Ingresa el folio"
                            style="border: 1px solid #000;"
                          />
                        </div>
                        <div class="mb-3">
                          <label for="folioInput" class="form-label">IdPais:</label>
                          <input
                            v-model="idPais"
                            @input="validateInput"
                            type="text"
                            class=""
                            id="folioInput"
                            placeholder="Ingresa el idPais"
                            style="border: 1px solid #000;"
                          />
                        </div>
                        <div class="mb-3">
                          <label for="folioInput" class="form-label">idCanal:</label>
                          <input
                            v-model="idCanal"
                            @input="validateInput"
                            type="text"
                            class=""
                            id="folioInput"
                            placeholder="Ingresa el idCanal"
                            style="border: 1px solid #000;"
                          />
                        </div>
                         <div class="mb-3">
                          <label for="folioInput" class="form-label">idSucursal:</label>
                          <input
                            v-model="idSucursal"
                            @input="validateInput"
                            type="text"
                            class=""
                            id="folioInput"
                            placeholder="Ingresa el idSucursal"
                            style="border: 1px solid #000;"
                          />
                        </div>

                             <div class="mb-3">
                          <label for="folioInput" class="form-label">numeroTelefono:</label>
                          <input
                            v-model="numeroTelefono"
                            @input="validateInput"
                            type="text"
                            class=""
                            id="folioInput"
                            placeholder="Ingresa el numeroTelefono"
                            style="border: 1px solid #000;"
                          />
                        </div>
                         <div class="mb-3">
                          <label for="folioInput" class="form-label">idCampana:</label>
                          <input
                            v-model="idCampana"
                            @input="validateInput"
                            type="text"
                            class=""
                            id="folioInput"
                            placeholder="Ingresa el idCampana"
                            style="border: 1px solid #000;"
                          />
                        </div>
                         <div class="mb-3">
                          <label for="folioInput" class="form-label">token:</label>
                          <input
                            v-model="token"
                            @input="validateInput"
                            type="text"
                            class=""
                            id="folioInput"
                            placeholder="Ingresa el token"
                            style="border: 1px solid #000;"
                          />
                        </div>
                            </div>
                            <div class="col-6">


                         <div class="mb-3">
                          <label for="folioInput" class="form-label">idOrigen:</label>
                          <input
                            v-model="idOrigen"
                            @input="validateInput"
                            type="text"
                            class=""
                            id="folioInput"
                            placeholder="Ingresa el idOrigen"
                            style="border: 1px solid #000;"
                          />
                        </div>

                        <div class="mb-3">
                          <label for="folioInput" class="form-label">idDespacho:</label>
                          <input
                            v-model="idDespacho"
                            @input="validateInput"
                            type="text"
                            class=""
                            id="folioInput"
                            placeholder="Ingresa el idDespacho"
                            style="border: 1px solid #000;"
                          />
                        </div>

                        <div class="mb-3">
                          <label for="folioInput" class="form-label">fecha:</label>
                          <input
                            v-model="fecha"
                            @input="validateInput"
                            type="text"
                            class=""
                            id="folioInput"
                            placeholder="Ingresa el fecha"
                            style="border: 1px solid #000;"
                          />
                        </div>

                        <div class="mb-3">
                          <label for="folioInput" class="form-label">Link generado cifrado:</label>
                          <p>{{encrypt2}} </p>
                        </div>
                            </div>
                        </div>
                      
                         

                        <div class="col-auto">
                          <button @click="sendRequest" class="" data-bs-toggle="modal" data-bs-target="#exampleModal">CONSULTAR</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Campaign</div>

                    <div class="card-body">
                       <div>
                        <!-- Botón para activar la solicitud -->
                        <button @click="consultarAPI" class="">Consultar API</button>
                      </div>
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
                 <a :href="encrypt" target="_blank">Mostrar la direccion</a>
                 <h4>Direccion generada:</h4>
                 <p>{{encrypt}} </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
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
          url:"https://www.gestioncobranzabaz.com.mx/regional/front-gestiones/index.html#/front-cobranza/credimax/",
          encrypt:'',
          idPais:"",
          idCanal:"",
          idSucursal:"",
          folio2:"",
          numeroTelefono:"",
          idCampana:"",
          numeroEmpleado:"",
          token:"",
          idOrigen:"",
          idDespacho:"",
          fecha:"",
          encrypt2:'',

        };
      },
        mounted() {
            console.log('Component Consultar.')
        },
         methods: {
    async consultarAPI() {
          try {
            const idDespacho = 15; 
            const apiUrl = `https://www.gestioncobranzabaz.com.mx/GestionesCC/v1/consulta-campania?idDespacho=${idDespacho}`;

            const headers = {
              'Content-Type': 'application/json',
              'Authorization': 'Basic ' + btoa('JeYXUErLkDgWzA9Pp8c2uMOkSppDq9YafWQzXVkv6itpvVrGejXSf:kDF3NFAPwKyPU8JS+Q25nAb0Fn66/RrtlJ3kofnJ8VOcbiraA0nU6w'), 
              'x-api-key': 'SDRgX_Jv8vziBFIQHSCNcCIkc6pmJHlPcDUFl8lWajg=', 
            };

            const response = await axios.post(apiUrl, {}, { headers });

            console.log('Respuesta de la API:', response.data);
          } catch (error) {
            
            console.error('Error en la solicitud:', error);
          }
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

       const headers = {
              'Content-Type': 'application/json',
              'Authorization': 'Basic ' + btoa('JeYXUErLkDgWzA9Pp8c2uMOkSppDq9YafWQzXVkv6itpvVrGejXSf:kDF3NFAPwKyPU8JS+Q25nAb0Fn66/RrtlJ3kofnJ8VOcbiraA0nU6w'), 
              'x-api-key': 'SDRgX_Jv8vziBFIQHSCNcCIkc6pmJHlPcDUFl8lWajg=', 
            };

      const jsonData = {
           "clienteUnico":{
              "idPais":1,
              "idCanal":1,
              "idSucursal":115,
              "folio":1969
           },
           "numeroTelefono":"559840744",
           "idCampana":1738,
           "numeroEmpleado":"800046",
           "token":"Cobranza2022",
           "idOrigen":2,
           "idDespacho":1,
           "fecha":"19/12/2022 13:20:00"
        }
        ;

         const jsonData2 = {
           "clienteUnico":{
              "idPais":this.idPais,
              "idCanal":this.idCanal,
              "idSucursal":this.idSucursal,
              "folio":this.folio2
           },
           "numeroTelefono":this.numeroTelefono,
           "idCampana":this.idCampana,
           "numeroEmpleado":this.numeroEmpleado,
           "token":this.token,
           "idOrigen":this.idOrigen,
           "idDespacho":this.idDespacho,
           "fecha":this.fecha
        }
        ;

        const encryptionKey = '192cY7vUQbodWq4q';

         const encryptedData = this.encryptJSON2(jsonData, '192cY7vUQbodWq4q'); 

         const encryptedData2 = this.encryptJSON2(jsonData2, '192cY7vUQbodWq4q');

  
         this.encrypt = this.url+encryptedData;
         this.encrypt2 = this.url+encryptedData2;

         console.log("URL A CONSULTAR",this.encrypt);
         console.log("Datos Json:",jsonData2);
         console.log("URL A CONSULTAR",this.encrypt2);

      this.showModal = true;
      // axios
      //   .get('https://cll.apps.cbz.baz.cloud:8444/regional/front-gestiones/index.html#/front-cobranza/credimax/'+encryptedData)
      //   .then((response) => {
      //     if (response.data === "correcto") {
      //       this.showModal = true;
      //       this.successMessage = "Respuesta correcta";
      //       this.startCountdown();
      //     } else {
            
      //       this.errorMessage = "Error en la respuesta";
      //     }
      //   })
      //   .catch((error) => {
      //     this.showModal = true;
      //     this.errorMessage = "Error en la solicitud";
      //   });
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
    }
</script>
