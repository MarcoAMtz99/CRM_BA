<template>
  <div class="container">
    <div class="row justify-content-center">
      <div>
        <div class="form-group mt-3">
                           <h2 class="title">Consulta por fecha:</h2>

                        </div>
        <!-- Dos inputs de fecha y botón de búsqueda -->
         <div class="form-group mt-3">
                            <label for="start_date">Fecha de Inicio</label>
                                   <input type="date" class="form-control" id="fechaInicio" v-model="fechaInicio" :max="fechaHoy" />

                        </div>
                        <div class="form-group mt-3">
                          <label for="fechaFinal">Fecha de final</label>
              <input type="date" class="form-control" id="fechaFinal" v-model="fechaFinal" :max="fechaHoy" />

      </div>
      <div class="form-group m-3">
              <button @click="consultaExport" class="btn btn-primary flex " :disabled="loading">Buscar</button>
    <button v-if="tablaData.length > 0" @click="exportarCSV" class="btn btn-primary m-1">Exportar</button>

      </div>
      <div class="form-group m-3">
                 <!-- Mostrar el botón Exportar cuando hay datos en tablaData -->

      </div>

    

        
      </div>

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
          <h1 class="justify-content-center ">Cargando clientes entre estas fechas...</h1>
        </div>
      </div>

      <!-- Contenido de la página -->
      <div v-else>
        <div class="col-md-12">
                <div class="card border-dark mb-3">
                    <div class="card-header">Campaña detalle </div>

                    <div class="card-body">
                       <div>
                        <!-- <button @click="exportToCSV" class="btn btn-primary mb-3">Descargar CSV</button> -->
                  
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
                        },
                      }"
                          class="table table-hover table-striped" width="100%">
                          <thead>
                              <tr>
                                  <th>Campaña</th>
                                  <th>Nombre</th>
                                  <th>Id Unico</th>
                                  <th>Telefono 1</th>
                                  <th>Telefono 2</th>
                                  <th>Telefono 3</th>
                                  <th>Fecha</th>

                                  <th>Acciones</th>




                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="item in tablaData" :key="item.id">
                                <td>{{ item.idCampania  }}</td>
                                <td>{{ item.nombre}} {{ item.apellidoPaterno}} {{ item.apellidoMaterno}}</td>
                                <td>{{ item.idUnico  }}</td>
                                <td>{{ item.telefono1  }}</td>
                                <td>{{ item.telefono2  }}</td>
                                <td>{{ item.telefono3  }}</td>
                                <td style="font-size:12px ">{{ formatTime(item.fecha_asignacion) }}</td>

                                <td>
                                  <button @click="mostrarAlert(item.folio, item.idSucursal, item.idCampania,item.telefono1 ,item.idCanal )" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Ver</button>
                           </td>

                </tr>
            </tbody>
             <tfoot>
             <tr>
                                  <th>Campaña</th>
                                  <th>Nombre</th>
                                  <th>Id Unico</th>
                                  <th>Telefono 1</th>
                                  <th>Telefono 2</th>
                                  <th>Telefono 3</th>
                                  <th>Fecha</th>

                                  <th>Acciones</th>




                              </tr>
        </tfoot>
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
import axios from 'axios';
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
      loading: false,
      fechaInicio: '',
      fechaFinal: '',
      fechaHoy: new Date().toISOString().split('T')[0],
      tablaData: [],
      // loading: false,
      currentPage: 1,
      itemsPerPage: 100,
      searchQuery: "",
      numeroEmpleado:"",
      filtro:null,
      linkLoading:true,
      cipherText: "", 
      showModal: false, 
      filters: {},
    };
  },
   mounted() {           
            this.numeroEmpleado = this.numero;
            console.log("EMPLEADO LOG",this.numeroEmpleado,this.numero);
        },
  methods: {
    formatTime(datetime) {
      const date = new Date(datetime);
      const formattedDate = `${date.getFullYear()}-${this.formatTwoDigits(date.getMonth() + 1)}-${this.formatTwoDigits(date.getDate())}`;
      const formattedTime = `${this.formatTwoDigits(date.getHours())}:${this.formatTwoDigits(date.getMinutes())}:${this.formatTwoDigits(date.getSeconds())}`;
      return `${formattedDate}`;
    },
    formatTwoDigits(value) {
      return value < 10 ? `0${value}` : value;
    },
    async consultaExport() {
      if (this.fechaFinal > this.fechaHoy) {
        console.log('La fecha final no puede ser mayor a hoy');
        return;
      }

      try {
        this.loading = true;
        const apiUrl = '/export-clients'; 
        const response = await axios.post(apiUrl, {
          start_date: this.fechaInicio,
          end_date: this.fechaFinal,
        });
        this.tablaData = response.data.clients;

         this.loading = false;
        console.log('Respuesta exitosa:', response.data);
          this.numeroEmpleado = response.data.employee;
      } catch (error) {
        console.error('Error en la solicitud:', error);
        // Manejo de errores
      } finally {
        this.loading = false;
      }
    },
     exportarCSV() {
      try {
        const data = this.tablaData.map((item) => {
          return item; 
        });

        const csvContent = this.convertArrayToCSV(data);
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8' });
        saveAs(blob, 'clientes.csv');
      } catch (error) {
        console.error('Error al exportar datos a CSV:', error);
      }
    },
    convertArrayToCSV(data) {
      const header = Object.keys(data[0]).join(",");
              const rows = data.map(item => Object.values(item).join(","));
              return header + "\n" + rows.join("\n");
    },

     mostrarAlert( folio, idSucursal, idCampania,telefono1,canal) {
           
                this.linkLoading = true;

                console.log(this.numeroEmpleado);
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
                this.linkLoading = true;
                setTimeout(function(){
                   window.open(response.data.cipherText, '_blank'); // Abre el enlace en una nueva pestaña
                  this.linkLoading = false;
                   this.linkLoading = false;
                    }, 2000);
                this.linkLoading = false;

                } else {
                  
                }
              })
              .catch((error) => {
                
                console.log(error);
               
              });
          },

  },
};
</script>

<style>
/* Estilos si los necesitas */
</style>
