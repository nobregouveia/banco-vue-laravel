<template>
  <div id="home-page">
    <a-layout id="container-layout" class="layout">
      <a-layout-header class="navbar">
        <div class="logo font-blue" :style="{ fontSize: '22px' }">
          <div>
            <img src="../assets/capgemini.svg" alt="capgemini" />
          </div>
        </div>
      </a-layout-header>
      <a-layout-content style="margin: 15px; padding: 0 60px">
        <div>
          <div class="info-conta">
            <div id="card-conta">
              <view-data
                :handleOperation="callOperation"
                :saldoUsuario="saldo"
              />
              <a-modal
                v-model="mostrarForm"
                :title="titleOperation"
                :footer="null"
              >
                <operation-form
                  :operationType="operationType"
                  :handleSendOperation="sendOperation"
                  :handleCancelOperation="() => (mostrarForm = false)"
                />
              </a-modal>
            </div>
          </div>
          <div class="body-content">
            <div id="list-extrato" class="card-content">
              <h1 :style="{ textAlign: 'left', paddingLeft: '30px' }">
                <a-icon type="profile" /> Extrato
              </h1>
              <a-list
                class="demo-loadmore-list"
                :loading="loading"
                item-layout="horizontal"
                :data-source="listaExtrato"
              >
                <div
                  v-if="showLoadingMore"
                  slot="loadMore"
                  :style="{
                    textAlign: 'center',
                    marginTop: '12px',
                    height: '32px',
                    lineHeight: '32px',
                  }"
                >
                  <a-spin v-if="loadingMore" />
                </div>
                <a-list-item slot="renderItem" slot-scope="item, index">
                  <div class="content-item" :key="index">
                    <p>
                      <a-icon type="clock-circle" />{{ " " }}
                      <strong>{{ item.created_at | getHours }}</strong>
                    </p>
                    <p
                      :style="{
                        display: 'flex',
                        justifyContent: 'left',
                        minWidth: '80px',
                        gap: '10px',
                      }"
                    >
                      <strong>
                        <a-tag color="green" v-if="item.tipo === 'DEPOSITO'">
                          <a-icon type="plus" v-if="item.tipo === 'DEPOSITO'" />
                        </a-tag>
                        <a-tag color="red" v-if="item.tipo === 'SAQUE'">
                          <a-icon type="minus" v-if="item.tipo === 'SAQUE'" />
                        </a-tag>
                      </strong>
                      {{ item.tipo === "SAQUE" ? "Saque" : "Depósito" }}
                    </p>
                    <p><strong>R$ </strong> {{ item.valor }}</p>
                  </div>
                </a-list-item>
              </a-list>
            </div>
          </div>
        </div>
      </a-layout-content>
      <a-layout-footer style="text-align: center">
        Capgemini ©2021 Desenvolvido e Mantido por André Gouveia.
      </a-layout-footer>
    </a-layout>
  </div>
</template>

<script>
// @ is an alias to /src
import OperationForm from "../components/MyProfile/OperationForm.vue";
import ViewData from "../components/MyProfile/ViewData.vue";
import { http } from "../services/config";

export default {
  components: {
    ViewData,
    OperationForm,
  },
  name: "Home",
  data() {
    return {
      loading: true,
      loadingMore: false,
      showLoadingMore: true,
      listaExtrato: [],
      usuario: {
        nome: "André F. Gouveia",
        conta: "321",
        agencia: "793",
        codigo: "08",
      },
      saldo: 0,
      mostrarForm: false,
      titleOperation: "Depositar",
      operationType: "",
    };
  },
  async mounted() {
    try {
      // const { conta, agencia, codigo } = this.usuario;
      // let response = await http.get(`/contas/extrato/${conta}/${codigo}/${agencia}`);
      let response = await http.get("/contas/extrato/321/08/793");
      this.listaExtrato = response.data;
      this.loading = false;
    } catch (error) {
      return error.response.data;
    }

    await this.buscarSaldo();
    await this.buscarExtrato();
  },

  filters: {
    getHours(val) {
      return new Date(val).toLocaleString("pt");
    },
  },

  methods: {
    async buscarSaldo() {
      try {
        let response = await http.get("/contas/saldo/321/08/793");
        this.saldo = response.data.saldo;
      } catch (error) {
        return error.response.data;
      }
    },
    async buscarExtrato() {
      try {
        let response = await http.get("/contas/extrato/321/08/793");
        this.listaExtrato = response.data;
      } catch (error) {
        return error.response.data;
      }
    },
    callOperation(operation) {
      this.titleOperation = operation === "DEPOSITO" ? "Depositar" : "Sacar";
      this.mostrarForm = true;
      this.operationType = operation;
    },
    async sendOperation(data) {
      if (this.saldo < data.valor && this.operationType !== "DEPOSITO") {
        this.$message.error("Saldo insuficiente");
        return;
      }

      let response = await http.post("/contas/transacao", data);

      if (!response.erro) {
        this.$message.success("Transação efetuada com sucesso.");
      }
      await this.buscarSaldo();
      await this.buscarExtrato();
      this.mostrarForm = false;
    },
  },
};
</script>

<style lang="scss">
#home-page {
  .navbar {
    background: rgb(231, 228, 19);
    .ant-menu {
      background: #f8e90f;
      color: #f8e90f;
    }
  }
  #container-layout .logo {
    width: 120px;
    display: flex;
    height: 80px;
    margin: 0 auto;
    justify-content: center;
    align-items: center;
  }
}

#list-extrato {
  margin: 50px 0;
  .demo-loadmore-list {
    min-height: 350px;
    max-height: 600px;
    overflow-y: auto;
    .content-item {
      display: flex;
      gap: 10px 50px;
      flex-wrap: wrap;
      width: 100%;
      justify-content: space-around;
    }
  }
}
.SAQUE {
  color: red;
}
</style>
