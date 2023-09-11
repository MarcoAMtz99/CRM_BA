<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-dark mb-3">
                    <div class="card-header">Campaña detalle</div>

                    <div class="card-body">
                       <div>
                        <button @click="exportToCSV" class="btn btn-primary mb-3">Descargar CSV</button>
                        <div class="mb-3">
                          <input type="text" v-model="searchQuery" class="form-control" placeholder="Buscar por Nombre, Folio o Teléfono">
                        </div>
                        <table class="table table-striped table-bordered">
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
                                <button @click="viewAction(index)" class="btn btn-info">
                                  <i class="fa fa-eye"></i> Ver
                                </button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="pagination">
                        <button @click="prevPage" :disabled="currentPage === 1" class="btn btn-info"> Ant </button>
                        <span>Página {{ currentPage }}</span>
                        <button @click="nextPage" :disabled="currentPage * itemsPerPage  >= filteredClientes.length" class="btn btn-info"> Sig </button>
                      </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
        return {
          clientes: [],
          currentPage: 1,
          itemsPerPage: 10,
          searchQuery: "",
        };
      },
        mounted() {
            // console.log('Component Consultar.')
            this.consultarAPI();
        },
        computed: {
         filteredClientes() {
            const searchTerm = this.searchQuery.trim();
            if (searchTerm === "") {
              return this.clientes;
            }
            const lowerCaseSearchTerm = searchTerm.toLowerCase();
            return this.clientes.filter(item => {
              return (
                item['nombre'].toLowerCase().includes(lowerCaseSearchTerm) ||
                item['folio'].toString().includes(searchTerm) ||
                item['telefono1'].includes(searchTerm) ||
                item['telefono2'].includes(searchTerm) ||
                item['telefono3'].includes(searchTerm)
              );
            });
          },
          paginatedClientes() {
            const startIndex = (this.currentPage - 1) * this.itemsPerPage;
            const endIndex = startIndex + this.itemsPerPage;
            return this.filteredClientes.slice(startIndex, endIndex);
          },
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
             const data = {
              "codigo": "201.CobranzaCredito-Call-Center-Gestion.155201",
              "mensaje": "Operación exitosa.",
              "folio": "155-202110181604535600",
              "info": "201.CobranzaCredito-Call-Center.155201",
              "resultado": {
                "clientes": [
                  {
                    "idCampania": 1260,
                    "idPais": 1,
                    "idCanal": 1,
                    "idSucursal": 2138,
                    "folio": 98862,
                    "semanasAtraso": 2,
                    "saldo": 9789,
                    "saldoCapital": 1000,
                    "pagoRequerido": 226,
                    "nombre": "LAURA",
                    "apellidoPaterno": "VAZQUEZ",
                    "apellidoMaterno": "VAZQUEZ",
                    "telefono1": 5577846122,
                    "tipoTelefono1": "MOVIL",
                    "telefono2": 5527846122,
                    "tipoTelefono2": "MOVIL",
                    "telefono3": 5517846122,
                    "tipoTelefono3": "FIJO",
                    "diaPago": 3,
                    "diasAtraso": 1,
                    "pagoMinimo": 0,
                    "pagoNoGeneraIntereses": 0,
                    "pagoDisponible": 668,
                    "abonoPuntual": 226,
                    "abonoSemanal": 0,
                    "capacidadPago": 668,
                    "creditoActivo": 1,
                    "fechaProximaPago": "2022-06-30",
                    "fechaVencimiento": "2022-06-30",
                    "creditoAutorizado": null,
                    "tasaInteres": "0",
                    "calle": "string",
                    "numeroInterior": "string",
                    "numeroExterior": "string",
                    "colonia": "string",
                    "codigoPostal": "string"
                  },
                  {
                    "idCampania": 1260,
                    "idPais": 1,
                    "idCanal": 1,
                    "idSucursal": 2138,
                    "folio": 98862,
                    "semanasAtraso": 2,
                    "saldo": 9789,
                    "saldoCapital": 1000,
                    "pagoRequerido": 226,
                    "nombre": "LAURA",
                    "apellidoPaterno": "VAZQUEZ",
                    "apellidoMaterno": "VAZQUEZ",
                    "telefono1": 5531124258,
                    "tipoTelefono1": "MOVIL",
                    "telefono2": 5531124258,
                    "tipoTelefono2": "MOVIL",
                    "telefono3": 5531124258,
                    "tipoTelefono3": "FIJO",
                    "diaPago": 3,
                    "diasAtraso": 1,
                    "pagoMinimo": 0,
                    "pagoNoGeneraIntereses": 0,
                    "pagoDisponible": 668,
                    "abonoPuntual": 226,
                    "abonoSemanal": 0,
                    "capacidadPago": 668,
                    "creditoActivo": 1,
                    "fechaProximaPago": "2022-06-30",
                    "fechaVencimiento": "2022-06-30",
                    "creditoAutorizado": null,
                    "tasaInteres": "0",
                    "calle": "string",
                    "numeroInterior": "string",
                    "numeroExterior": "string",
                    "colonia": "string",
                    "codigoPostal": "string"
                  },{
                    "idCampania": 1260,
                    "idPais": 1,
                    "idCanal": 1,
                    "idSucursal": 2138,
                    "folio": 213456,
                    "semanasAtraso": 2,
                    "saldo": 9789,
                    "saldoCapital": 1000,
                    "pagoRequerido": 226,
                    "nombre": "LAURA",
                    "apellidoPaterno": "VAZQUEZ",
                    "apellidoMaterno": "VAZQUEZ",
                    "telefono1": 5531124258,
                    "tipoTelefono1": "MOVIL",
                    "telefono2": 5531124258,
                    "tipoTelefono2": "MOVIL",
                    "telefono3": 5531124258,
                    "tipoTelefono3": "FIJO",
                    "diaPago": 3,
                    "diasAtraso": 1,
                    "pagoMinimo": 0,
                    "pagoNoGeneraIntereses": 0,
                    "pagoDisponible": 668,
                    "abonoPuntual": 226,
                    "abonoSemanal": 0,
                    "capacidadPago": 668,
                    "creditoActivo": 1,
                    "fechaProximaPago": "2022-06-30",
                    "fechaVencimiento": "2022-06-30",
                    "creditoAutorizado": null,
                    "tasaInteres": "0",
                    "calle": "string",
                    "numeroInterior": "string",
                    "numeroExterior": "string",
                    "colonia": "string",
                    "codigoPostal": "string"
                  },{
                    "idCampania": 1260,
                    "idPais": 1,
                    "idCanal": 1,
                    "idSucursal": 2138,
                    "folio": 987654,
                    "semanasAtraso": 2,
                    "saldo": 9789,
                    "saldoCapital": 1000,
                    "pagoRequerido": 226,
                    "nombre": "LAURA",
                    "apellidoPaterno": "VAZQUEZ",
                    "apellidoMaterno": "VAZQUEZ",
                    "telefono1": 5531124258,
                    "tipoTelefono1": "MOVIL",
                    "telefono2": 5531124258,
                    "tipoTelefono2": "MOVIL",
                    "telefono3": 5531124258,
                    "tipoTelefono3": "FIJO",
                    "diaPago": 3,
                    "diasAtraso": 1,
                    "pagoMinimo": 0,
                    "pagoNoGeneraIntereses": 0,
                    "pagoDisponible": 668,
                    "abonoPuntual": 226,
                    "abonoSemanal": 0,
                    "capacidadPago": 668,
                    "creditoActivo": 1,
                    "fechaProximaPago": "2022-06-30",
                    "fechaVencimiento": "2022-06-30",
                    "creditoAutorizado": null,
                    "tasaInteres": "0",
                    "calle": "string",
                    "numeroInterior": "string",
                    "numeroExterior": "string",
                    "colonia": "string",
                    "codigoPostal": "string"
                  }
                ]
              }
            };
            // const response = await axios.post(apiUrl, {}, { headers });
            this.clientes = data.resultado.clientes;
            console.log('Respuesta de la API:',  this.clientes);
          } catch (error) {
            
            console.error('Error en la solicitud:', error);
          }
            },
          viewAction(index) {
              // Implementa aquí la acción para ver los detalles del ítem
              console.log('Ver detalles de', this.clientes[index]);
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
