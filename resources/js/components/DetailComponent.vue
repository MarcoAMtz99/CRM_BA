<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-dark mb-3">
                    <div class="card-header">Campaña detalle</div>

                    <div class="card-body">
                       <div>
                        <button @click="exportToCSV" class="btn btn-primary mb-3">Descargar CSV</button>
                       <!--  <div class="mb-3">
                          <input type="text" v-model="searchQuery" class="form-control" placeholder="Buscar por Nombre, Folio o Teléfono">
                        </div> -->
                       <!--  <table class="table table-striped table-bordered">
                          <thead class="thead-dark">
                            <tr>
                              <th>Nombre</th>
                              <th>Folio</th>
                              <th>Telefono 1</th>
                              <th>Telefono 2</th>
                              <th>Telefono 3</th>
                              <th>Accion</th>


                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(item, index) in paginatedClientes" :key="index">
                              <td>{{item['nombre']}} {{item['apellidoPaterno']}} {{item['apellidoMaterno']}}</td>
                              <td>{{item['folio']}}</td>
                              <td>{{item['telefono1']}}</td>
                              <td>{{item['telefono2']}}</td>
                              <td>{{item['telefono3']}}</td>


                              <td>
                                <button @click="sendRequest(item)" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal">
                                  <i class="fa fa-eye"></i> Ver
                                </button>
                              </td>
                            </tr>
                          </tbody>
                        </table> -->
                        <!-- <div class="pagination">
                        <button @click="prevPage" :disabled="currentPage === 1" class="btn btn-info"> Ant </button>
                        <span>Página {{ currentPage }}</span>
                        <button @click="nextPage" :disabled="currentPage * itemsPerPage  >= filteredClientes.length" class="btn btn-info"> Sig </button>
                      </div> -->
                      </div>
                       <div>

                        <div>
                         
                        <h1>Clientes de la campaign</h1>
                        <DataTable :data="tablaData" class="table table-hover table-striped" width="100%">
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
                      </DataTable>
                  
                       <!--  <client-table :data="tablaData" :columns="columnas"></client-table>
                         <bootstrap-table2 :data="tablaData" :columns="columnas"></bootstrap-table2> -->
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
          <a :href="cipherText" target="_blank" class="btn btn-primary" style="width:100%;">Abrir link</a>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net-bs5';
// import DataTablesCore from 'datatables.net';

DataTable.use(DataTablesCore);
    export default {
       props: {
        id: Number,
      },
      components: {
    DataTable, // Registra el componente aquí
  },
        data() {
        return {
          clientes: [],
          currentPage: 1,
          itemsPerPage: 100,
          searchQuery: "",
          showModal: false, 
         cipherText: "", 
         tablaData: [],
      columnas: [
        // Define las columnas de la tabla
        {
          label: 'ID',
          field: 'id',
        },
        {
          label: 'Nombre',
          field: 'nombre',
        },
        {
          label: 'Edad',
          field: 'edad',
        },
        // ...
      ],
      filtro:null,
        };
      },
        mounted() {
            console.log('ID URL.',this.id);
            this.idUrl = this.id;
            this.consultarAPI();
        },
        computed: {
         
        },
        created() {
      
      },
         methods: {
          mostrarAlert( folio, idSucursal, idCampania) {
            alert(`Haz clic en ${nombre}. Folio: ${folio}, Sucursal: ${idSucursal}, Campania: ${idCampania}`);
            // Puedes usar 'nombre', 'folio', 'idSucursal' e 'idCampania' como sea necesario
          },
         async consultarAPI() {
          try {
            const idDespacho = 15; 
            const apiUrl = `https://www.gestioncobranzabaz.com.mx/GestionesCC/v1/consulta-clientes?idDespacho=${idDespacho}&idCampana=${this.idUrl}`;

            const headers = {
              'Content-Type': 'application/json',
              'Authorization': 'Basic ' + btoa('JeYXUErLkDgWzA9Pp8c2uMOkSppDq9YafWQzXVkv6itpvVrGejXSf:kDF3NFAPwKyPU8JS+Q25nAb0Fn66/RrtlJ3kofnJ8VOcbiraA0nU6w'), 
              'x-api-key': 'SDRgX_Jv8vziBFIQHSCNcCIkc6pmJHlPcDUFl8lWajg=', 
            };
             
            const response = await axios.post(apiUrl, {}, { headers });
            this.clientes = response.data.resultado.clientes;
            console.log('Respuesta de la API:',response);
            console.log('Respuesta de la API:',  this.clientes,response);
              this.tablaData = this.clientes.map((item) => [
                  item.nombre,
                  item.folio,
                  item.telefono1,
                  item.telefono2,
                  item.telefono3,
                  `
                  <button @click="mostrarAlert('${item.folio}', '${item.idSucursal}', '${item.idCampania}')" class="btn btn-primary">Mostrar Alert</button>
                  `,
                ]);

                console.log(" this.tablaData",this.tablaData);
          } catch (error) {
            
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
          } else {
            // this.showModal = true;
            // this.errorMessage = "Error en la respuesta";
          }
        })
        .catch((error) => {
          // this.showModal = true;
          // console.log(error);
          // this.errorMessage = "Error en la solicitud";
        });

  



    },
            exportToCSV() {
              const data = this.clientes;
              const csvContent = "data:text/csv;charset=utf-8," + this.convertArrayToCSV(data);
              const encodedUri = encodeURI(csvContent);
              const link = document.createElement("a");
              link.setAttribute("href", encodedUri);
              link.setAttribute("download", "clientes.csv");
              document.body.appendChild(link);
              link.click();
            },
            convertArrayToCSV(data) {
              const header = Object.keys(data[0]).join(",");
              const rows = data.map(item => Object.values(item).join(","));
              return header + "\n" + rows.join("\n");
            },

             prevPage() {
              if (this.currentPage > 1) {
                this.currentPage--;
              }
            },
            nextPage() {
              const totalPages = Math.ceil(this.filteredClientes.length / this.itemsPerPage);
              if (this.currentPage < totalPages) {
                this.currentPage++;
              }
            },


      },
    }
</script>
<style>
@import 'bootstrap';
@import 'datatables.net-bs5';
</style>