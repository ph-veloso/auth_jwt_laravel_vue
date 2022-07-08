<template>
  <main class="form-signin w-100 m-auto">
    <form @submit.stop.prevent="submit">
      <h1 class="h3 mb-3 fw-normal">Olá, visitante!</h1>

      <div class="form-floating">
        <input
          v-model="data.email"
          type="text"
          class="form-control"
          id="floatingInput"
          placeholder="nome@exemplo.com"
        />
        <label for="floatingInput">Email ou CPF</label>
      </div>
      <div class="form-floating">
        <input
          v-model="data.password"
          type="password"
          class="form-control"
          id="floatingPassword"
          placeholder="Password"
        />
        <label for="floatingPassword">Senha</label>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit">Logar</button>
      <hr/>
      <div class="row">
        <div class="h5 col-6">
          <label for="semLogin" class="form-label">Não tem login? </label>
        </div>
        <div class="h4 col-6">
          <router-link to="/cadastro">Cadastre-se</router-link>
        </div>
      </div>
    </form>
  </main>
</template>

<script>
import Cookie from "js-cookie";
import { reactive } from "@vue/reactivity";
import { useRouter } from "vue-router";

export default {
  name: "LoginForm",

  setup() {
    const data = reactive({
      email: "",
      password: "",
    });

    const router = useRouter();

    const submit = async () => {
      await fetch("http://127.0.0.1:8000/api/login", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
        body: JSON.stringify(data),
      })
        .then((response) => response.json())
        .then(async (res) => {
          if (res.error != "Unauthorized") {
            await Cookie.set("_pontotel_token", res.access_token);
          }
        })
        .then(() => {
          router.push("/home");
        });
    };

    return {
      data,
      submit,
    };
  },
};
</script>
<style>
.form-signin {
  max-width: 330px;
  padding: 15px;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
body {
  background-color: #d3cedf;
}
form{
  padding-top: 30%;
}
</style>