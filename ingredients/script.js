const { createApp } = Vue;

createApp({
    data() {
        return {
            apiUrl: 'api.php',
            ingredients: [],
            newIngredient:{
                'name' : '',
                'quantity' : '',
                'date' : '',
            },
            createUrl: 'create.php',
            deleteUrl: 'delete.php',
        };
    },
    methods: {

        addingredient() {
            
            axios.post(this.createUrl, {
                ingredient: this.newIngredient
            }, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            ).then(() => {
                this.ids = this.ids + 1;
                this.ingredients.push({
                    name: this.newIngredient.name,
                    quantity: this.newIngredient.quantity,
                    date: this.newIngredient.date,
                });

                this.newingredient.name = '';
                this.newingredient.quantity = '';
                this.newingredient.date = '';
            });
        },

        delingredient(index){
            axios.post(this.deleteUrl, {
                ingredient: this.ingredients[index]
            }, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            ).then(() => {
                this.ingredients.splice(index , 1);
            });
        },

    },
    created() {
        axios
            .get(this.apiUrl)
            .then((response) => {
                this.ingredients = response.data.ingredients;
            });
    },
}).mount('#app');