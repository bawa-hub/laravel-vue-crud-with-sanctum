import { createRouter, createWebHistory } from "vue-router";
import login from "./pages/login.vue";
import register from "./pages/register.vue";
import home from "./pages/home.vue";
import addEmployee from "./pages/employees/addEmployee.vue";
import editEmployee from "./pages/employees/editEmployee.vue";

const routes = [
    { path: "/", name: "Home", component: home, meta: { requiresAuth: true } },
    {
        path: "/employees/add",
        name: "AddEmployee",
        component: addEmployee,
        meta: { requiresAuth: true },
    },
    {
        path: "/employees/edit/:id",
        name: "EditEmployee",
        component: editEmployee,
        meta: { requiresAuth: true },
    },
    {
        path: "/login",
        name: "Login",
        component: login,
        meta: { requiresAuth: false },
    },
    {
        path: "/register",
        name: "Register",
        component: register,
        meta: { requiresAuth: false },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from) => {
    if (to.meta.requiresAuth && !localStorage.getItem("token")) {
        return { name: "Login" };
    }

    if (to.meta.requiresAuth == false && localStorage.getItem("token")) {
        return { name: "Home" };
    }
});

export default router;
