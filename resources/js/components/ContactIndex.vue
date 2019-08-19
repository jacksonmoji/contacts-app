<template>
    <div>
        <button class="btn btn-info" @click="showCreateModal = true;"> <h5 class="mb-0">Add New Contact</h5></button>
        <table class="table table-boarderless" id="table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Surname</th>
                    <th>Country Code</th>
                    <th>Phone</th>
                    <th>Actions</th>    
                </tr>
            </thead>
            <tr v-for="(contact,index) in contacts" :key="contact.id">
                <td>
                    <input readonly class="form-control-plaintext"  type="text" v-model="contact.First_name">
                </td>
                <td>
                    <input readonly class="form-control-plaintext"  type="text" v-model="contact.surname">
                </td>
                <td>
                    <input readonly class="form-control-plaintext"  type="text" v-model="contact.country_code">
                </td>
                <td>
                    <input readonly class="form-control-plaintext"  type="text" v-model="contact.phone">
                </td>
                <td>
                    <button id="show-modal" @click="showEditModal=true; editContact_(index)" class="btn">
                        <span class="fas fa-pen-square"></span>
                    </button>
                    <button @click.prevent="removeContact(index)" class="btn"><span class="fas fa-trash-alt"></span></button>
                </td>
            </tr>
        </table>

        <modal v-if="showEditModal" @close="showEditModal=false">
            <h3 slot="header"> Edit Contact </h3>
            <div slot="body">
                <div class="form-group">
                    <label for="Firstname">First Name:</label>
                    <input type="text" placeholder="First Name" class="form-control" v-model="contact.First_name">
                </div>
                <div class="form-group">
                    <label for="Surname">Surname:</label>
                    <input class="form-control" placeholder="Surname" v-model="contact.surname"> 
                </div> 
                <div class="form-group">
                    <label>Country Code:</label>
                    <input type="text" placeholder="Country Code" class="form-control" v-model="contact.country_code">
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input class="form-control" placeholder="Phone Number" v-model="contact.phone"> 
                </div> 
            </div>  
            <div slot="footer">
                <button type="button" @click="showEditModal=false;" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" @click="updateContact();  showEditModal=false;" class="btn btn-primary">Submit</button>
            </div> 
        </modal>
      
        <modal v-if="showCreateModal" @close="showCreateModal=false">
            <h3 slot="header"> New Contact </h3>
            <div slot="body">
               <div class="form-group">
                    <label for="Firstname">First Name:</label>
                    <input type="text" placeholder="First Name" class="form-control" v-model="newContact.First_name">
                </div>
                <div class="form-group">
                    <label for="Surname">Surname:</label>
                    <input type="text" class="form-control" placeholder="Surname" v-model="newContact.surname"> 
                </div> 
                <div class="form-group">
                    <label>Country Code:</label>
                    <input type="text" placeholder="Country Code" class="form-control" v-model="newContact.country_code">
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="number" class="form-control" placeholder="Phone Number" v-model="newContact.phone"> 
                </div>
            </div>  
            <div slot="footer">
                <button type="button" @click="showCreateModal=false;" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" @click="saveContacts(); showCreateModal=false;" class="btn btn-primary">Submit</button>
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
            contacts: [],
            current_contact:[],
            newContact: { First_name:'', surname:'', country_code:'', phone: 0, user_key: 1},
            feedback: '',
            showEditModal: false,
            showCreateModal: false
        };
    },
    created (){
        this.getContacts(); 
    },
    methods: {
        getContacts(){
            axios.get('/api/contacts/index')
            .then((res) => {
                if (res.data.success){
                    this.contacts = res.data.contacts;
                }
            })
        },
        editContact_(index){
            this.contact = this.contacts[index];
        },
        removeContact(index) {
            if (confirm('Are you sure?')){
                let id = this.contacts[index].id;
                if (id > 0) {
                    axios.delete('/api/contacts/' + id );
                }
                this.contacts.splice(index,1);
            }
        },
        updateContact(){
            axios.put('/api/contacts/edit', {
                    contacts: this.contacts
                })
                .then((res) => {
                    if (res.data.success){
                        this.feedback = 'changes have been captured successfully';
                        this.contacts = res.data.contacts;
                    }
                })
            },
        addContact(){
            this.contacts.push({
                First_name: this.newContact.First_name,
                surname: this.newContact.surname,
                country_code: this.newContact.country_code,
                phone: this.newContact.phone,
            });

            this.saveContacts();
        },
        saveContacts() {
            
            axios.post('/api/contacts/store', {
                contacts: this.newContact
            })
            .then((res) => {
                if (res.data.success){
                    this.feedback = 'New Contact captured successfully';
                    this.contacts = res.data.contacts;
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