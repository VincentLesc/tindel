<template>
    <div>
        <v-toolbar dark color="primary">
            <v-toolbar-title>My personal profile</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
            <v-form>
                <v-text-field v-model="profile.title" name="title" label="title" type="text"></v-text-field>
                <v-text-field v-model="profile.description" name="description" label="description" type="text"></v-text-field>
                <v-select v-model="profile.ethnicity" :items="ethnicity" label="ethnicity" name="ethnicity"></v-select>
                <v-menu
                        ref="menu"
                        v-model="menu"
                        :close-on-content-click="false"
                        :nudge-right="40"
                        lazy
                        transition="scale-transition"
                        offset-y
                        full-width
                        min-width="290px"
                >
                    <template v-slot:activator="{ on }">
                        <v-text-field
                                v-model="date"
                                label="Birthday date"
                                prepend-icon="event"
                                readonly
                                v-on="on"
                        ></v-text-field>
                    </template>
                    <v-date-picker
                            ref="picker"
                            v-model="date"
                            :max="new Date().toISOString().substr(0, 10)"
                            min="1950-01-01"
                            @change="save"
                    ></v-date-picker>
                </v-menu>
            </v-form>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" v-on:click="update">Login</v-btn>
        </v-card-actions>
    </div>
    <!--    <form class="form-signin">-->
    <!--        <h1 class="h3 mb-3 font-weight-normal">My Profile</h1>-->
    <!--        <div class="input-group">-->
    <!--            <label for="inputTitle" class="sr-only">Title</label>-->
    <!--            <input v-on:keyup="length" v-model="profile.title" :maxlength="32" type="text" id="inputTitle" class="form-control" placeholder="Title" autofocus>-->
    <!--            <div v-if="(this.profile.title.length !== 0)" class="input-group-append">-->
    <!--                <span v-if="(this.profile.title.length !== maxtitle)" class="input-group-text" v-text="(this.profile.title.length + '/' + maxtitle)"></span>-->
    <!--                <span v-else class="input-group-text" >Max length reached</span>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="input-group">-->
    <!--            <label for="inputDescription" class="sr-only">Description</label>-->
    <!--            <input v-on:keyup="length" v-model="profile.description" type="text" id="inputDescription" class="form-control" placeholder="Description">-->
    <!--            <div v-if="(this.profile.description.length !== 0)" class="input-group-append">-->
    <!--                <span v-if="(this.profile.description.length !== maxdescription)" class="input-group-text" v-text="(this.profile.description.length + '/' + maxdescription)"></span>-->
    <!--                <span v-else class="input-group-text">Max length reached</span>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="form-group">-->
    <!--            <label for="ethnicitySelect" class="sr-only">Example select</label>-->
    <!--            <select v-model="profile.ethnicity" class="form-control" id="ethnicitySelect">-->
    <!--                <option v-for="e in ethnicity">{{e}}</option>-->
    <!--            </select>-->
    <!--        </div>-->
    <!--        <div class="form-group">-->
    <!--            <label for="birthdate" class="sr-only">Example select</label>-->
    <!--            <input v-model="profile.birthdate" type="date" id="birthdate">-->
    <!--        </div>-->
    <!--        <div v-if="updated">-->
    <!--            <alert context="alert-success mt-1" message="Updated"></alert>-->
    <!--        </div>-->
    <!--        <div v-on:click="update" class="btn btn-lg btn-primary btn-block">Update</div>-->
    <!--    </form>-->
</template>

<script>

    import Alert from '../../components/Alert';
    import Datetime from 'vue-date-picker';

    export default {
        name: 'profileForm',
        created () {
            this.$store.dispatch('userProfile/fetchProfile');
        },
        components: {
            Alert,
            Datetime
        },
        data: function () {
            return {
                maxtitle: 32,
                maxtotype : 0,
                maxdescription: 500,
                maxtotypeDescription: 0,
                ethnicity: ['European', 'Arabic', 'Latino'],
                menu: false,
                date: this.profile.birthdate
            }
        },
        computed: {
            profile() {
                return this.$store.getters['userProfile/profile'];
            },
            updated() {
                return this.$store.getters['userProfile/updated'];
            }
        },
        methods: {
            update() {
                let payload = {title: this.profile.title, description: this.profile.description, ethnicity: this.profile.ethnicity, birthdate: this.profile.birthdate};
                return this.$store.dispatch('userProfile/updateProfile', payload);
            },
            length() {
                this.maxtotype= this.maxtitle-this.profile.title.length;
                this.maxtotypeDescription = this.maxdescription - this.profile.description.length;
            },
            save () {
                this.$refs.menu.save(this.profile.birthdate)
            }
        },
        watch: {
            menu (val) {
                val && setTimeout(() => (this.$refs.picker.activePicker = 'YEAR'))
            }
        }
    }
</script>
