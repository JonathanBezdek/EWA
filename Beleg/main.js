let App = new Vue({
    el: '#app',
    data() {
        return {
            filtervisible: false,
            emailPlaceholder: "",
            Searchemail: "",
            searchResults: [],
            searchQuery: "",
            rooms: [],
            selected: { Zimmer_ID: "", name: "" },
            selectedEmail: { kundenemail: "" },
            Anreisedatum: "",
            Abreisedatum: "",
            price: "",
            kundenemail: "",
            email: "",
            admin_email: "",
            buchungen: [],
            admins: [],
            table_visible: false,
        }
    },
    methods: {
        changePlaceholder() {
            this.getDays(this.Anreisedatum, this.Abreisedatum);
            this.emailPlaceholder = 'Gesamtpreis: ' + this.price + "€";
        },
        onSubmit: function (event) {
            event.preventDefault(); // Verhindert das Standardverhalten des Browsers für Formularübermittlungen
            this.insertData();
        },
        fetchData() {
            // fetch("data_calendar.json")
            //     .then(response => response.json())
            //     .then((data) => {
            //         this.buchungen = data.buchungen;
            //     });

            // fetch für zimmer
            fetch("https://ivm108.informatik.htw-dresden.de/ewa/g08/Beleg/Ausgabe_Zimmer.php")
                .then(response => {
                    console.log(response);
                    return response.json();
                })
                .then((data) => {
                    console.log(data);
                    this.rooms = data;
                    console.log(this.rooms);
                });

            // fetch für buchungen
            fetch("https://ivm108.informatik.htw-dresden.de/ewa/g08/Beleg/Ausgabe_Buchungen.php")
                .then(response => {
                    console.log(response);
                    return response.json();
                })
                .then((data) => {
                    console.log(data);
                    this.buchungen = data;
                    console.log(this.buchungen);
                });

            // fetch für admins
            fetch("https://ivm108.informatik.htw-dresden.de/ewa/g08/Beleg/Ausgabe_Admins.php")
                .then(response => {
                    console.log(response);
                    return response.json();
                })
                .then((data) => {
                    console.log(data);
                    this.admins = data;
                    console.log('admins: ');
                    console.log(this.admins);
                });

            // fetch("https://ivm108.informatik.htw-dresden.de/ewa/g08/Beleg/Email_Suche.php")
            //     .then(response => {
            //         console.log(response);
            //         return response.json();
            //     })
            //     .then((data) => {
            //         console.log(data);
            //         this.searchResults = data;
            //         console.log(this.searchResults);
            //     });
        },

        insertData: function (event) {
            this.getDays(this.Anreisedatum, this.Abreisedatum);
            //event.preventDefault(); // verhindern Sie die Standardformularaktion
            fetch('https://ivm108.informatik.htw-dresden.de/ewa/g08/Beleg/Insert.php', {
                method: 'POST',
                body: new URLSearchParams({
                    'email': this.email,
                    'Anreisedatum': this.Anreisedatum,
                    'Abreisedatum': this.Abreisedatum,
                    'zimmerID': this.selected.Zimmer_ID,
                    'preis': this.price,
                })

            })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    $
                    console.error(error);
                });
            console.log(this.price);
        },
        searchEmail() {

            console.log(this.filtervisible);
            this.filtervisible = true;
            console.log("danach: " + this.filtervisible);
            fetch('https://ivm108.informatik.htw-dresden.de/ewa/g08/Beleg/Email_Suche.php', {
                method: 'POST',
                body: new URLSearchParams({
                    'emailEingabe': this.Searchemail,
                })
            })

                .then(response => response.json())
                .then(data => {
                    console.log('emails:');
                    console.log(data);
                    this.searchResults = data;
                    console.log(this.searchResults.length);
                })

        },
        getDate() {
            console.log("Anreisedatum: " + this.Anreisedatum)
            console.log("Abreisedatum: " + this.Abreisedatum)
            console.log("E-Mail: " + this.email)
            console.log(this.selected.Name)
        },

        selectItem(room) {
            this.selected = room;
        },
        selectEmail(selectedEmail) {
            this.selectedEmail = selectedEmail;
        },

        getDays(anreise, abreise) {
            anreise = this.formatDate(anreise);
            abreise = this.formatDate(abreise);

            // Datum in JavaScript Date-Objekte konvertieren
            var dateObj1 = new Date(anreise);
            var dateObj2 = new Date(abreise);

            // Unterschied in Millisekunden berechnen
            var diffInMilliseconds = Math.abs(dateObj2 - dateObj1);

            // Unterschied in NÄCHTEN (deshalb -1)
            var diffInDays = Math.ceil(diffInMilliseconds / (1000 * 60 * 60 * 24));

            // Ergebnis anzeigen
            this.getPrice(diffInDays);
        },

        formatDate(date) {
            // Datum in ein JavaScript Date-Objekt konvertieren
            var dateObj = new Date(date);

            // Gewünschtes Format erstellen
            var tag = dateObj.getDate();
            var monat = dateObj.getMonth() + 1; // Monate werden von 0 bis 11 gezählt, daher +1
            var jahr = dateObj.getFullYear();

            // Führende Nullen hinzufügen
            if (tag < 10) {
                tag = '0' + tag;
            }

            if (monat < 10) {
                monat = '0' + monat;
            }

            // Datum im gewünschten Format zusammenstellen
            var formatiertesDatum = monat + '/' + tag + '/' + jahr;

            // Ergebnis anzeigen
            return formatiertesDatum;
        },
        getPrice(nights) {
            this.price = this.selected.Preis_pro_Nacht * nights;
            return this.price;
        },


        login() {
            for (let i = 0; i < this.admins.length; i++) {
                if (this.admins[i].Admin_Adressen === this.admin_email) {
                    this.table_visible = true
                    console.log('Success')
                }
            }
        }
    },
    mounted() {
        this.fetchData();
    },
});