<template>
  <div id="view-card" class="card-content">
    <a-row :gutter="16">
      <a-col :span="8">
        <a-card id="card-saldo" :bordered="false">
          <template slot="extra">
            <a-statistic title="Saldo" prefix="R$" :value="saldoUsuario" />
          </template>
        </a-card>
      </a-col>   
       <div class="extra" style="float: right">
         
          <div
            :style="{
              display: 'flex',
              width: 'max-content',
              justifyContent: 'flex-end',
              gap: '10px',
            }"
            class="btn-actions"
          >
            <a-button
              key="1"
              @click="handleOperation('DEPOSITO')"
              type="primary"
              class="btn-primary"
            >
              Depositar
            </a-button>
            <a-button
              key="2"
              @click="handleOperation('SAQUE')"
              type="danger"
              class="btn-danger"
            >
              Sacar
            </a-button>         
          </div>
        </div>  
    </a-row>

    <a-page-header sub-title="Informações da conta">
      <div class="content" style="text-align: left">
        <div class="main">
          <a-descriptions size="small" :column="3">
            <a-descriptions-item>
              <h3 class="name">
               <a-icon type="user" />
                <strong> {{ usuario.nome }}</strong>
              </h3>
            </a-descriptions-item>
             <a-descriptions-item label="Ag.">
              <h3 class="agency">
                <a-icon type="bank" />
                <b> {{ usuario.agencia }}</b>
              </h3>
            </a-descriptions-item>
            <a-descriptions-item label="Conta:">
              <h3 class="account-number">
                <a-icon type="key" />
                <b> {{ usuario.conta }}</b>
              </h3>
            </a-descriptions-item>           
          </a-descriptions>
        </div>       
      </div>
    </a-page-header>
  </div>
</template>
<script>
export default {
  name: "view-data",
  data() {
    return {
      usuario: {
        nome: "André F. Gouveia",
        conta: "321",
        agencia: "793",
        codigo: "08",
      },
    };
  },

  props: {
    dataObject: {
      type: Object,
      required: false,
      default: () => {
        return {
          name: "Nome do Cliente",
          account_number: "xxx.xxx.xxx-xx",
          agency: "xxx-xx",
          balance: 0,
        };
      },
    },
    handleOperation: {
      type: Function,
      required: true,
      default: () => {},
    },
    saldoUsuario: {
      type: Number,
      required: true,
      default: 0,
    },
  } 
};
</script>
<style lang="scss">
#view-card {
  tr:last-child td {
    padding-bottom: 0;
  }
  .content {
    display: flex;
  }
  .ant-statistic-content {
    font-size: 20px;
    line-height: 28px;
  }

  .extra {
    display: flex;
    align-items: flex-end;
    .btn-actions {
      @media screen and (max-width: 500px) {
        flex-direction: column;
      }
    }
  }

  @media (max-width: 576px) {
    .content {
      display: block;
    }

    .main {
      width: 100%;
      margin-bottom: 12px;
    }

    .extra {
      width: 100%;
      margin-left: 0;
      text-align: left;
    }
  }

  #card-saldo {
    background: #e7e413;
    border-radius: 5px;
    text-align: left;
    margin: 0 auto;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    transition: all 0.3s cubic-bezier(.25,.8,.25,1);
  }

  #card-saldo:hover {
      box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
  }

  .ant-card-extra {
    margin-left: 0;
  }

  .ant-descriptions-row {
    text-align: center;
  }

}
</style>
