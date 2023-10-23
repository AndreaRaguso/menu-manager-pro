const { createApp } = Vue;


createApp({
    data() {
        return {
            apiUrl: 'api.php',
            expiryIngredient : [],
            listIngredient : [],
            dishOffer : [],
        };

    },

    methods: {

        removeIngredient(ingredientId) {
            const index = this.newdish.ingredients.indexOf(ingredientId);
            if (index !== -1) {
                this.newdish.ingredients.splice(index, 1);
            }
        },


        deldish(index){
            axios.post(this.deleteUrl, {
                dish: this.dishes[index]
            }, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            ).then(() => {
                this.dishes.splice(index , 1);
            });
        },

    },
    created() {

        //Expiring Ingredients
        axios.get('/ingredients/expiry.php')
        .then(response => {
            console.log(response.data.ingredients);
            this.expiryIngredient = response.data.ingredients;
        })
        .catch(error => {
            console.error("Errore nel recupero degli ingredienti: " + error);
        });

        //List Ingredients
        axios.get('/ingredients/list.php')
        .then(response => {
            this.listIngredient = response.data.ingredients;
        })
        .catch(error => {
            console.error("Errore nel recupero degli ingredienti: " + error);
        });

        //Dish Offer
        axios.get('/dish/dish.php')
        .then(response => {
            this.dishOffer = response.data.dishes;
            console.log(this.dishOffer);
        })
        .catch(error => {
            console.error("Errore nel recupero degli ingredienti: " + error);
        });

    },
    
}).mount('#app');