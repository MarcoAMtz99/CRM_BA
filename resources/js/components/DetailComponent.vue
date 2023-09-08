<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-dark mb-3">
                    <div class="card-header">Campañas</div>

                    <div class="card-body">
                       <div>
                        <button @click="downloadCSV" class="btn btn-primary mb-3">Descargar CSV</button>
                        <table class="table table-striped table-bordered">
                          <thead class="thead-dark">
                            <tr>
                              <th>ID</th>
                              <th>Tipo de Campaña</th>
                              <th>Acción</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(item, index) in campanias" :key="index">
                              <td>{{ item.id }}</td>
                              <td>{{ item.tipoCampania == 1 ? "inbount": "outbount" }}</td>
                              <td>
                                <button @click="viewAction(index)" class="btn btn-info">
                                  <i class="fa fa-eye"></i> Ver
                                </button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
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
          campanias: [],
        };
      },
        mounted() {
            // console.log('Component Consultar.')
            this.consultarAPI();
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
              "codigo": "200.CobranzaCredito-Call-Center.155200",
              "mensaje": "Operación exitosa.",
              "folio": "155-202000021116513300",
              "resultado": {
                "campanias": [
                  {
                    "id": 72,
                    "tipoCampania": 2
                  },
                  {
                    "id": 73,
                    "tipoCampania": 1
                  },
                  {
                    "id": 74,
                    "tipoCampania": 2
                  },
                  {
                    "id": 75,
                    "tipoCampania": 2
                  },
                  {
                    "id": 78,
                    "tipoCampania": 1
                  }
                ]
              }
            };
            // const response = await axios.post(apiUrl, {}, { headers });
            this.campanias = data.resultado.campanias;
            console.log('Respuesta de la API:',  this.campanias);
          } catch (error) {
            
            console.error('Error en la solicitud:', error);
          }
            },
    viewAction(index) {
              // Implementa aquí la acción para ver los detalles del ítem
              console.log('Ver detalles de', this.tableData[index]);
            },
            downloadCSV() {
              const csvContent = 'data:text/csv;charset=utf-8,';
              csvContent += 'ID,Tipo de Campaña\n'; // Encabezados

              this.tableData.forEach((item) => {
                csvContent += `${item.id},${item.campaignType}\n`;
              });

              const encodedUri = encodeURI(csvContent);
              const link = document.createElement('a');
              link.setAttribute('href', encodedUri);
              link.setAttribute('download', 'data.csv');
              document.body.appendChild(link);
              link.click();
            },


      },
    }
</script>
