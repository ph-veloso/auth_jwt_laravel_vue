<template>
  <div>
    <h1 id="tituloLogout">Você está deslogando!</h1>
  </div>
</template>

<script>
import Cookie from "js-cookie";
import { useRouter } from "vue-router";

export default {
  name: "LogoutPage",
  mounted() {
    const router = useRouter();

    setTimeout(async () => {
        Cookie.remove("_pontotel_token");
        
        await router.push("/login");

    }, 1000);
  },
};
</script>
<style scoped>
    #tituloLogout {
        text-align: center;
        font-size: 50px;
        font-weight: bold;
        padding-top: 25%;
    }
</style>