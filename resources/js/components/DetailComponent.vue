<template>
    <div class="container">
        <div class="row justify-content-center">
          <div>
    <!-- Loader -->
    <div v-if="loading" class="loader">
       <div class="d-flex justify-content-center">

       <div class="spinner-grow m-5" style="width: 3rem; height: 3rem;" role="status">
              <span class="visually-hidden">Clientes...</span>
            </div>
            <div class="spinner-grow m-5" style="width: 3rem; height: 3rem;" role="status">
              <span class="visually-hidden">Clientes...</span>
            </div>
            <div class="spinner-grow m-5" style="width: 3rem; height: 3rem;" role="status">
              <span class="visually-hidden">Clientes...</span>
            </div>
            <div class="spinner-grow m-5" style="width: 3rem; height: 3rem;" role="status">
              <span class="visually-hidden">Clientes...</span>
            </div>
            <div class="spinner-grow m-5" style="width: 3rem; height: 3rem;" role="status">
              <span class="visually-hidden">Clientes...</span>
            </div>
            <div class="spinner-grow m-5" style="width: 3rem; height: 3rem;" role="status">
              <span class="visually-hidden">Clientes...</span>
            </div>
            <div class="spinner-grow m-5" style="width: 3rem; height: 3rem;" role="status">
              <span class="visually-hidden">Clientes...</span>
            </div>
        

      </div>
     

      <div class="d-flex justify-content-center">
  <!-- <div class="spinner-border" role="status">

    <span class="visually-hidden">Loading...</span>
  </div> -->
      <h1 class="justify-content-center ">Cargando Clientes...</h1>

</div>
  
    </div>
    
    <!-- Contenido de la página -->
    <div v-else>
      <div class="col-md-12">
                <div class="card border-dark mb-3">
                    <div class="card-header">Campaña detalle <strong>{{idUrl}} </strong> / Empleado: {{numero}} </div>

                    <div class="card-body">
                       <div>
                        <button @click="exportToCSV" class="btn btn-primary mb-3">Descargar CSV</button>
                  
                      </div>
                       <div>

                        <div>
                         
                        <h1>Clientes de la campaña</h1>
                        <DataTable
                          
                         :options="{language:{
                            decimal:'',
                            emptyTable:'No hay información',
                            info:'Mostrando _START_ a _END_ de _TOTAL_ Entradas',
                            infoEmpty:'Mostrando 0 to 0 of 0 Entradas',
                            infoFiltered:'(Filtrado de _MAX_ total entradas)',
                            infoPostFix:'',
                            thousands:',',
                            lengthMenu:'Mostrar _MENU_ Entradas',
                            loadingRecords:'Cargando...',
                            processing:'Procesando...',
                            search:'Buscar:',
                            zeroRecords:'Sin resultados encontrados',
                            paginate:{
                                first:'Primero',
                                last:'Ultimo',
                                next:'Siguiente',
                                previous:'Anterior'
                            }
                        }
                      }"
                          class="table table-hover table-striped" width="100%">
                          <thead>
                              <tr>
                                  <th>Nombre</th>
                                  <th>Folio</th>
                                  <th>Telefono 1</th>
                                  <th>Telefono 2</th>
                                  <th>Telefono 3</th>
                                  <th>Acciones</th>



                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="item in tablaData" :key="item.id">
                                <td>{{ item[0] }}</td>
                                <td>{{ item[1]  }}</td>
                                <td>{{ item[2]  }}</td>
                                <td>{{ item[3]  }}</td>
                                <td>{{ item[4]  }}</td>
                                <td>
                                  <button @click="mostrarAlert(item[1], item[5], item[6],item[2],item[7])" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Ver</button>
                           </td>

                </tr>
            </tbody>
                      </DataTable>
                  
                       <!--  <client-table :data="tablaData" :columns="columnas"></client-table>
                        <button @click="sendRequest(item)" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal">
                                  <i class="fa fa-eye"></i> Ver
                                </button>
                         <bootstrap-table2 :data="tablaData" :columns="columnas"></bootstrap-table2> -->
                      </div>
                      </div>
                    </div>
                </div>
            </div>
    </div>
  </div>
            
        </div>
    </div>

 <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog ">
      <div class="modal-content border-dark" style="box-shadow: 10px 5px 5px black;">
        <div class="modal-header border-dark" >
          <h5 class="modal-title" id="exampleModalLabel">Consultar folio</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body ">
          <p>Link generado con exito, da click en el boton para visualizar en una nueva ventana la informacion</p>
          <div v-if="linkLoading">
            <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
          </div>
          <a v-else :href="cipherText" target="_blank" class="btn btn-primary" style="width:100%;">Abrir link</a>

         
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import { saveAs } from "file-saver";
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net-bs5';

DataTable.use(DataTablesCore);
    export default {
       props: ['id','numero'],
      components: {
    DataTable, 
  },
        data() {
        return {
          clientes: [],
          loading: true,
          currentPage: 1,
          itemsPerPage: 100,
          searchQuery: "",
          showModal: false, 
          cipherText: "", 
          tablaData: [],
          filtro:null,
          linkLoading:true,
          userName:'',
          numeroEmpleado:'',
        };
      },
        mounted() {
            this.idUrl = this.id;
            this.userName= this.user;
            this.numeroEmpleado = this.numero;
            this.consultarAPI();
            console.log("EMPLEADO LOG",this.numeroEmpleado,this.numero);
        },
        computed: {
         
        },
        created() {
        this.numeroEmpleado = this.numero;
      },
         methods: {
         async consultarAPI() {
          try {
            const idDespacho = 15; 
            const apiUrl = `https://www.gestioncobranzabaz.com.mx/GestionesCC/v2/consulta-clientes?idDespacho=${idDespacho}&idCampana=${this.idUrl}`;

            const headers = {
              'Content-Type': 'application/json',
              'Authorization': 'Basic ' + btoa('JeYXUErLkDgWzA9Pp8c2uMOkSppDq9YafWQzXVkv6itpvVrGejXSf:kDF3NFAPwKyPU8JS+Q25nAb0Fn66/RrtlJ3kofnJ8VOcbiraA0nU6w'), 
              'x-api-key': 'SDRgX_Jv8vziBFIQHSCNcCIkc6pmJHlPcDUFl8lWajg=', 
            };
             
            const response = await axios.post(apiUrl, {}, { headers });

            this.clientes = response.data.resultado;
  

            this.tablaData = this.clientes.map((item) => {
              const nombreCompleto = `${item.nombre} ${item.apellidoPaterno} ${item.apellidoMaterno}`;

              let telefono1 = "";
              let telefono2 = "";
              let telefono3 = "";

              if (item.telefonos && item.telefonos.length > 0) {
                // Asignar hasta 3 números de teléfono
                for (let i = 0; i < Math.min(item.telefonos.length, 3); i++) {
                  if (i === 0) {
                    telefono1 = item.telefonos[i].numero;
                  } else if (i === 1) {
                    telefono2 = item.telefonos[i].numero;
                  } else if (i === 2) {
                    telefono3 = item.telefonos[i].numero;
                  }
                }
              }

              return [
                nombreCompleto,
                item.folio,
                telefono1,
                telefono2,
                telefono3,
                item.idSucursal,
                item.idCampania,
                item.idCanal
              ];
            });

              this.loading = false;

                } catch (error) {
              this.loading = false;
                  
                  console.error('Error en la solicitud:', error);
                }
                  },
                viewAction(index) {
                    console.log('Ver detalles de', this.clientes[index]);
                  },
                sendRequest(item) {

                  // console.log(item);

            // this.showModal = true;
            // this.countdown=300;

            const Data = {
                "folio": item.folio,
                "idCampania":item.idCampania,
                "idSucursal":item.idSucursal,
            };


            axios
              .post('/generate-link', { Data }) 
              .then((response) => {
                  console.log(response.data);

                if (response.data.status === true) {
                this.cipherText = response.data.cipherText;
                this.showModal = true; 
                this.linkLoading = false;
                } else {
                  
                }
              })
              .catch((error) => {
                // this.showModal = true;
                console.log(error);
                // this.errorMessage = "Error en la solicitud";
              });

        



          },
            exportToCSV() {
             try {
                // const data = this.clientes;
             const data = this.clientes.map((item) => {
                  let rowData = {};

                  for (const key in item) {
                    if (Array.isArray(item[key])) {
                      // Si es un array, itera sobre los elementos y agrega sus propiedades con las mismas claves
                      item[key].forEach((arrayItem, index) => {
                        for (const arrayItemKey in arrayItem) {
                          rowData[`${key}_${index}_${arrayItemKey}`] = arrayItem[arrayItemKey];
                        }
                      });
                    } else if (typeof item[key] === 'object') {
                      // Si es un objeto, itera sobre sus propiedades y agrega sus valores con las mismas claves
                      for (const subKey in item[key]) {
                        rowData[subKey] = item[key][subKey];
                      }
                    } else {
                      rowData[key] = item[key];
                    }
                  }

                  return rowData;
                });
                const csvContent = this.convertArrayToCSV(data);
                const blob = new Blob([csvContent], { type: "text/csv;charset=utf-8" });
                saveAs(blob, "clientes.csv");
              } catch (error) {
                console.error("Error al exportar datos a CSV:", error);
              }
            },
            mostrarAlert( folio, idSucursal, idCampania,telefono1,canal) {
           
                this.linkLoading = true;


            const Data = {
                "folio": folio,
                "idCampania":idCampania,
                "idSucursal":idSucursal,
                "numeroEmpleado":this.numeroEmpleado.toString(),
                "telefono1":telefono1,
                "idCanal":canal
            };


            axios
              .post('/generate-link', { Data }) 
              .then((response) => {
                  console.log(response.data);

                if (response.data.status === true) {
                this.cipherText = response.data.cipherText;
                this.showModal = true; 
                setTimeout(function(){
                   this.linkLoading = false;

                    }, 2000);
                this.linkLoading = false;

                } else {
                  // this.showModal = true;
                  // this.errorMessage = "Error en la respuesta";
                }
              })
              .catch((error) => {
                // this.showModal = true;
                console.log(error);
                // this.errorMessage = "Error en la solicitud";
              });
          },
            convertArrayToCSV(data) {
              const header = Object.keys(data[0]).join(",");
              const rows = data.map(item => Object.values(item).join(","));
              return header + "\n" + rows.join("\n");
            },
      },
    }
</script>
<style>
@import 'bootstrap';
@import 'datatables.net-bs5';
</style>