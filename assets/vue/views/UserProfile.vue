<template>
    <v-content>
        <v-container fluid fill-height>
            <v-layout align-center justify-center>
                <v-flex xs12 sm8 md4>
                    <profileForm></profileForm>
                </v-flex>
            </v-layout>
        </v-container>
    </v-content>
</template>

<script>

    import ProfileForm from '../components/user_profile_components/ProfileForm'

    export default {
        name: 'userProfile',
        components: {
            ProfileForm
        }
    }
</script>
