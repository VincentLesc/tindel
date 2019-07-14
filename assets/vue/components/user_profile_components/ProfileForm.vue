<template>
    <form class="form-signin">
        <h1 class="h3 mb-3 font-weight-normal">My Profile</h1>
        <div class="input-group">
            <label for="inputTitle" class="sr-only">Title</label>
            <input v-on:keyup="length" v-model="profile.title" :maxlength="32" type="text" id="inputTitle" class="form-control" placeholder="Title" autofocus>
            <div v-if="(this.profile.title.length !== 0)" class="input-group-append">
                <span v-if="(this.profile.title.length !== maxtitle)" class="input-group-text" v-text="(this.profile.title.length + '/' + maxtitle)"></span>
                <span v-else class="input-group-text" >Max length reached</span>
            </div>
        </div>
        <div class="input-group">
            <label for="inputDescription" class="sr-only">Description</label>
            <input v-on:keyup="length" v-model="profile.description" type="text" id="inputDescription" class="form-control" placeholder="Description">
            <div v-if="(this.profile.description.length !== 0)" class="input-group-append">
                <span v-if="(this.profile.description.length !== maxdescription)" class="input-group-text" v-text="(this.profile.description.length + '/' + maxdescription)"></span>
                <span v-else class="input-group-text">Max length reached</span>
            </div>
        </div>
        <div v-if="updated">
            <h2>Updated !</h2>
        </div>
        <div v-on:click="update" class="btn btn-lg btn-primary btn-block">Update</div>
    </form>
</template>

<script>
    export default {
        name: 'profileForm',
        created () {
            this.$store.dispatch('userProfile/fetchProfile');
        },
        data: function () {
            return {
                maxtitle: 32,
                maxtotype : 0,
                maxdescription: 500,
                maxtotypeDescription: 0
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
                let payload = {title: this.profile.title, description: this.profile.description};
                return this.$store.dispatch('userProfile/updateProfile', payload);
            },
            length() {
                this.maxtotype= this.maxtitle-this.profile.title.length;
                this.maxtotypeDescription = this.maxdescription - this.profile.description.length;
            }
        }
    }
</script>
