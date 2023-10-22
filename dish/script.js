const { createApp } = Vue;


createApp({
    data() {
        return {
            apiUrl: 'api.php',
            dishes: [],
            newdish:{
                'name' : '',
                'price' : '',
                'ingredients' : [],
            },
            createUrl: 'create.php',
            deleteUrl: 'delete.php',
            ingredientList: [],
            selectedIngredients: [],
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

        adddish() {
            
            axios.post(this.createUrl, {
                dish: this.newdish
            }, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            ).then(() => {
                this.ids = this.ids + 1;
                this.dishes.push({
                    name: this.newdish.name,
                    price: this.newdish.price,
                    ingredients: this.newdish.ingredients,
                });

                this.newdish.name = '';
                this.newdish.price = '';
                this.newdish.ingredients = [];
            });
        },

    },
    created() {


        axios.get(this.apiUrl)
        .then((response) => {
            this.dishes = response.data.dishes;
        })
        .catch((error) => {
            console.error("Errore nel recupero dei piatti: " + error);
        });


        axios.get('/PHP-TODO-LIST-JSON/ingredients/api.php')
        .then(response => {
            this.ingredientList = response.data.ingredients;
        })
        .catch(error => {
            console.error("Errore nel recupero degli ingredienti: " + error);
        });

    },
    
}).mount('#app');