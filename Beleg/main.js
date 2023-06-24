let App = new Vue({
    el: '#app',
    data() {
        return {
            zimmer: [], // hier werden die bücher gespeichert
            selected: { id: null, name: "" },
            Anreisedatum: "",
            Abreisedatum: "",
            greeting: 'Hello Vue 3!',
            isVisible: false,
            isVisible2: false,
            email: "",
            admin_email: "",
            buchungen: [],
        }
    },
    methods: {
        fetchData() {
            fetch("data_calendar.json")
                .then(response => response.json())
                .then((data) => {
                    this.buchungen = data.buchungen;
                })
            fetch("https://ivm108.informatik.htw-dresden.de/ewa/g08/Beleg/Auswahl.php")
                .then(response => {
                    console.log(response);
                    return response.json();
                })
                .then((data) => {
                    console.log(data);
                    this.zimmer = data;
                    console.log(this.zimmer);
                });
        },
        greet() {
            console.log(this.greeting)
        },
        getDate() {
            console.log("Anreisedatum: " + this.Anreisedatum)
            console.log("Abreisedatum: " + this.Abreisedatum)
            console.log("E-Mail: " + this.email)
            console.log(this.selected.Name)
        },
        selectItem(zimmer) {
            this.selected = zimmer;
        },
        login() {
            console.log(this.admin_email)
        }
    },
    mounted() {
        this.fetchData();
    },

});

