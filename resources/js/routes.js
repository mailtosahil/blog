import Index from "./components/dashboard/index.vue";

import postList from "./components/post/list.vue";
import postAdd from "./components/post/add.vue";
import postEdit from "./components/post/edit.vue";

import NotFoundPage from "./components/notfound.vue";

export const routes = [
    {
        name: "home",
        path: "/home",
        component: Index
    },
    {
        path: "/posts",
        component: postList
    },
    {
        path: "/post/add",
        component: postAdd
    },
    {
        path: "/post/edit/:id?",
        component: postEdit
    },
        {
        path: "*",
        component: NotFoundPage
    }
];
