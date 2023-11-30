<template>
  <div class="container">
    <div class="row justify-content-center">
      <div>
        <!-- Contenido de la página -->
        <div>
          <div class="col-md-12">
            <div class="card border-dark mb-3">
              <div class="card-header">Historial de links generados</div>

              <div class="card-body">
                <div>
                  <!-- <button @click="exportToCSV" class="btn btn-primary mb-3">Descargar CSV</button> -->
                </div>
                <div>
                  <h1>Historial</h1>
                  <h3>Total de links generados en este dia: {{count}} </h3>

 
 
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
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>IdUnico</th>
                                <th>Número empleado</th>
                                <th>Fecha</th>



                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="user in users" :key="user.id">
                                <td>{{ user.id }}</td>
                                <td>{{ user.user_name }}</td>
                                <td>{{ user.idUnico }}</td>
                                <td>{{ user.numeroEmpleado ? user.numeroEmpleado : "S/N" }}</td>
                                <td>{{ formatTime(user.created_at) }}</td>

                                

                        </tr>
                          </tbody>
                      </DataTable>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { saveAs } from "file-saver";
import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net-bs5";

DataTable.use(DataTablesCore);

export default {
  props: ['users','count'],
  components: {
    DataTable,
  },
  data() {
    return {
      usersLocal: [],
      userToDelete: null,
      userToEdit: {
        id: null,
        name: '',
        email: '',
        employee_number_id: '',
        password: '',
        confirmPassword: '',

      },
    };
  },
  mounted() {
    this.usersLocal = this.users;
    console.log(this.usersLocal)
  },
  methods: {
     formatTime(datetime) {
      const date = new Date(datetime);
      const formattedDate = `${date.getFullYear()}-${this.formatTwoDigits(date.getMonth() + 1)}-${this.formatTwoDigits(date.getDate())}`;
      const formattedTime = `${this.formatTwoDigits(date.getHours())}:${this.formatTwoDigits(date.getMinutes())}:${this.formatTwoDigits(date.getSeconds())}`;
      return `${formattedDate} ${formattedTime}`;
    },
    formatTwoDigits(value) {
      return value < 10 ? `0${value}` : value;
    },
 
  },
};
</script>

<style>
@import 'bootstrap';
@import 'datatables.net-bs5';
</style>
