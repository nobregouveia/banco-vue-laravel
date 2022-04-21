<template>
  <a-form-model
    ref="ruleForm"
    :model="form"
    :rules="rules"
    :label-col="labelCol"
    :wrapper-col="wrapperCol"
    id="form-operation"
  >
    <a-form-model-item ref="numero_conta" prop="numero_conta">
      <p class="title-section">Número da conta</p>
      <a-input-number
        class="input-number"
        :style="{ minWidth: '100%' }"
        v-model="form.numero_conta"
        @blur="
          () => {
            $refs.numero_conta.onFieldBlur();
          }
        "
      />
    </a-form-model-item>

    <a-form-model-item ref="agencia" prop="agencia">
      <p class="title-section">Agência</p>
      <a-input
        v-model.trim="form.agencia"
        @blur="
          () => {
            $refs.agencia.onFieldBlur();
          }
        "
      />
    </a-form-model-item>
    <a-form-model-item ref="codigo_conta" prop="codigo_conta">
      <p class="title-section">Código de segurança</p>
      <a-input
        v-model.trim="form.codigo_conta"
        @blur="
          () => {
            $refs.codigo_conta.onFieldBlur();
          }
        "
      />
    </a-form-model-item>
    <a-form-model-item ref="valor" prop="valor">
      <p class="title-section">Valor</p>
      <a-input-number
        type="number"
        min="0"
        :style="{ minWidth: '100%' }"
        v-model="form.valor"
      />
    </a-form-model-item>
    <a-form-model-item
      ref="password"
      prop="password"
      v-if="operationType === 'SAQUE'"
    >
      <p class="title-section">Senha</p>
      <a-input-password
        v-model.trim="form.password"
        type="password"
        @blur="
          () => {
            $refs.password.onFieldBlur();
          }
        "
      />
    </a-form-model-item>
    <a-form-model-item :wrapper-col="{ span: 24, offset: 0 }">
      <a-button class="btn-enter" @click="onSubmit"> Enviar </a-button>
      <a-popconfirm
        title="Tem certeza disso?"
        ok-text="Sim"
        cancel-text="Não"
        @confirm="resetForm"
        @cancel="() => {}"
      >
        <a-button style="margin-left: 10px"> Cancelar </a-button>
      </a-popconfirm>
    </a-form-model-item>
  </a-form-model>
</template>
<script>
export default {
  props: {
    handleSendOperation: {
      type: Function,
      required: true,
      default: () => {},
    },
    handleCancelOperation: {
      type: Function,
      required: true,
      default: () => {},
    },
    operationType: {
      type: String,
      required: true,
      default: null,
    },
  },

  data() {
    let ruler_default = [
      {
        required: true,
        message: "Preencha o campo acima",
        trigger: "blur",
      },
    ];
    return {
      labelCol: { span: 1 },
      wrapperCol: { span: 24 },
      other: "",
      form: {
        numero_conta: undefined,
        codigo_conta: undefined,
        agencia: undefined,
        valor: undefined,
        password: "",
      },
      rules: {
        account_number: [
          {
            type: "number",
            required: true,
            message: "Preencha o campo acima",
            trigger: "blur",
          },
        ],
        account_code: ruler_default,
        agency: ruler_default,
        password: ruler_default,
        amount: [
          {
            type: "number",
            required: true,
            message: "Preencha o campo acima",
            trigger: "blur",
          },
        ],
      },
    };
  },
  methods: {
    onSubmit() {
      this.$refs.ruleForm.validate((valid) => {
        if (valid) {
          if (this.operationType === "DEPOSITO") {
            delete this.form.password;
          }
          let data = { ...this.form, tipo: this.operationType };
          this.handleSendOperation(data);
          this.$refs.ruleForm.resetFields();
        } else {
          return false;
        }
      });
    },
    resetForm() {
      this.$refs.ruleForm.resetFields();
      this.$message.info("Operação cancelada");
      this.handleCancelOperation();
    },
  },
};
</script>

<style lang="scss" scoped>
.title-section {
  margin: 0;
}
</style>
<style lang="scss">
#form-operation {
  .ant-input-number-handler-wrap {
    display: none;
  }
}
</style>
