<template>
    <div>
        <div class="form-group">
            <label for="username" class="text-primary">Username</label>
            <input id="username" name="username" readonly class="form-control-plaintext"  type="text" v-model="profile.username">
        </div>
        <div class="form-group">
            <label for="Name" class="text-primary">Full Name</label>
            <input id="name" name="name" readonly class="form-control-plaintext" type="text" v-model="profile.name">
        </div>
        <div class="form-group">
            <label for="email" class="text-primary">Email</label>
            <input id="email" name="email" readonly class="form-control-plaintext"  type="text" v-model="profile.email">
        </div>
    
        <button id="show-modal" @click="showEditModal=true; editProfile_(index)" class="btn">
            <span class="fas fa-pen-square"></span>
        </button>
        <button @click.prevent="removeProfile(index)" class="btn"><span class="fas fa-trash-alt"></span></button>

        <modal v-if="showEditModal" @close="showEditModal=false">
            <h3 slot="header"> Edit Profile </h3>
            <div slot="body">
                <div class="form-group">
                    <label for="Name">Name:</label>
                    <input type="text" placeholder="Name" class="form-control" name="name" v-model="profile.name">
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input class="form-control" placeholder="Username" v-model="contact.username"> 
                </div> 
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input class="form-control" name="email" placeholder="Email" v-model="profile.email"> 
                </div> 
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" placeholder="Password" class="form-control" v-model="profile.password">
                </div>
            </div>  
            <div slot="footer">
                <button type="button" @click="showEditModal=false;" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" @click="updateProfile();  showEditModal=false;" class="btn btn-primary">Submit</button>
            </div> 
        </modal>
        <div> {{ feedback }} </div>
 </div>
</template>

<script>
import { constants } from 'crypto';
export default {
    data() {
        return {
            profile: [],
            feedback: '',
            showEditModal: false
        };
    },
    created (){
        this.getProfile(); 
    },
    methods: {
        getProfile(){
            axios.get('/api/profile')
            .then((res) => {
                if (res.data.success){
                    this.profile = res.data.profile;
                }
            })
        },
        editProfile_(index){
            this.contact = this.profile[index];
        },
        removeProfile(index) {
            if (confirm('Are you sure?')){
                let id = this.profile[index].id;
                if (id > 0) {
                    axios.delete('/api/profile/' + id );
                }
                this.profile.splice(index,1);
            }
        },
        updateProfile(){
            axios.put('/api/profile/edit', {
                    profile: this.profile
                })
                .then((res) => {
                    if (res.data.success){
                        this.feedback = 'changes have been captured successfully';
                        this.profile = res.data.profile;
                    }
                })
            }
    }
}
</script>

<style>
    hr {
        margin-bottom: 30px;
    }
</style>