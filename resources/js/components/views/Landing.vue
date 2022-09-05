<template>
    <v-app >
        <views-navigation :color="color" :flat="flat" />
        <div>
            <!-- ======= Hero Section ======= -->
            <section style="background-color:#1f2630" class="hero-section" id="hero"  v-if="!userId">
                <v-container>
                    <v-row justify="center" class="align-items-center">
                        <v-col cols="12" xl="8" class="hero-text-image">
                            <v-row>
                                <v-col
                                    cols="12"
                                    lg="6"
                                    class="text-center text-lg-left"
                                >
                                    <h1 data-aos="fade-right" style="margin-top:50px" >
                                        <strong style="color:white">Alt</strong><strong style="color:rgba(248,217,75, 0.8)">Ex</strong>
                                    </h1>
                                    <p
                                        class="mb-5"
                                        data-aos="fade-right"
                                        data-aos-delay="100"
                                        style="color:white"
                                        
                                    >
                                        {{myJson.tagline}}
                                    </p>
                                    <p
                                        class="mb-5"
                                        data-aos="fade-right"
                                        data-aos-delay="100"
                                        style="color:white"
                                    >
                                    {{myJson.getItNow}}
                                    </p>
                                    <!-- <v-btn data-aos="fade-right" data-aos-delay="200" data-aos-offset="-500" color="primary" size="100px" rounded x-large class="btn-primary"></v-btn> -->
                                    <p
                                        data-aos="fade-right"
                                        data-aos-delay="200"
                                        data-aos-offset="-500"
                                    >
                                        <a
                                            class="btn btn-started"
                                            data-aos="fade-up"
                                            style="color:white; background-color:#00a170"
                                            @click="$router.push('/#')"
                                            >Google Play</a
                                        >
                                        <a
                                            style="color:white; background-color:#0883fe"
                                            class="btn btn-started"
                                            href="https://dl.altexc.com/"
                                            >App Store</a
                                        >
                                    </p>
                                </v-col>
                                <v-col
                                    cols="12"
                                    lg="6"
                                    class="hidden-md-and-down" >        
                                        <img
                                        width="100%"
                                        src="svg/Hero.svg"
                                        alt="Image"
                                        data-aos="fade-right"
                                    />
                                </v-col>
                            </v-row>
                        </v-col>
                    </v-row>
                </v-container>
            </section>
            <!-- End Hero -->

            <section style="background-color:#1f2630" id="about"  v-if="!userId">
                <v-container>
                    <v-row justify="center" class="align-items-center">
                        <v-row>
                        <center><h3 justify="center" class="align-items-center" style="color:rgba(248,217,75, 0.8)">{{myJson.aboutTitle}}</h3>
                        <br><span style="color:white">{{myJson.about_tagline}}</span></center>
                            <v-col style="margin-left:10%">
                            <img style="margin-top:40px"
                                        width="100%"
                                        src="svg/btc.svg"
                                        alt="Image"
                                        data-aos="fade-right"
                                    />
                        </v-col>
                        <v-col cols="12" md="6" style="color:white; ">
                                <v-row style="margin-top:40px">  
                                    <v-col cols="12" md="3">
                                        <img
                                        width="50%"
                                        src="svg/globe.png"
                                        alt="Image"
                                        data-aos="fade-right"
                                    />
                                    </v-col>
                                    <v-col cols="12" md="9" >
                                        <span>{{myJson.about_description_1}}</span>
                                    </v-col>
                                    <v-col cols="12" md="3">
                                        <img
                                        width="50%"
                                        src="svg/gem.png"
                                        alt="Image"
                                        data-aos="fade-right"
                                    >
                                    </v-col>
                                    <v-col cols="12" md="9">
                                        <span>{{myJson.about_description_2}}</span>
                                    </v-col>
                                    <v-col cols="12" md="3">
                                        <img
                                        width="50%"
                                        src="svg/networking.png"
                                        alt="Image"
                                        data-aos="fade-right"
                                    />
                                    </v-col>
                                    <v-col cols="12" md="9">
                                        <span>{{myJson.about_description_3}}</span>
                                    </v-col>
                                </v-row>
                        </v-col>
                        </v-row>
                    </v-row>
                
                </v-container>

            </section>

            <section style="background-color:#1f2630" id="about"  v-if="!userId">
                <v-container>
                    <v-row justify="center" class="align-items-center" style="color:rgba(248,217,75, 0.8); ">
                        <v-row style="margin-bottom:50px">
                        <center><h3 justify="center" class="align-items-center" style="color:rgba(248,217,75, 0.8); ">{{myJson.about_title_2}}</h3>
                        <br><span style="color:white"></span></center>
                            <v-col style="color:white;">
                                <v-row>  
                                    <v-col cols="12" md="3">
                                        <img
                                        width="50%"
                                        src="svg/computer.png"
                                        alt="Image"
                                        data-aos="fade-right"
                                    />
                                    </v-col>
                                    <v-col cols="12" md="9">
                                            <h4 style="color:rgba(248,217,75, 0.8)">{{myJson.about_safety}}</h4>
                                            <span><br/>{{myJson.about_safety_desc_1}}
                                                <br/>{{myJson.about_safety_desc_2}}
                                                <br/>{{myJson.about_safety_desc_3}}
                                                <br/>{{myJson.about_safety_desc_4}}</span>
                                    </v-col>
                                    <v-col cols="12" md="3">
                                        <img
                                        width="50%"
                                        src="svg/bitcoin.png"
                                        alt="Image"
                                        data-aos="fade-right"
                                    >
                                    </v-col>
                                    <v-col cols="12" md="9">
                                        <h4 style="color:rgba(248,217,75, 0.8)">{{myJson.about_globalization}}</h4>
                                        <span><br/>{{myJson.about_globalization_desc_1}}
                                               <br/>{{myJson.about_globalization_desc_2}}</span>
                                    </v-col>
                                </v-row>
                            </v-col>
                                <v-col cols="12" md="6" style="color:white;" >
                                <v-row>
                                
                                    <v-col cols="12" md="3">
                                        <img
                                        width="50%"
                                        src="svg/computer.png"
                                        alt="Image"
                                        data-aos="fade-right"
                                    />
                                    </v-col>
                                    <v-col cols="12" md="9">
                                        <h4 style="color:rgba(248,217,75, 0.8);">{{myJson.about_high_concurrency}}</h4>
                                        <span>{{myJson.about_high_concurrency_desc_1}}
                                            <br/>{{myJson.about_high_concurrency_desc_2}}
                                            <br/>{{myJson.about_high_concurrency_desc_3}}</span>
                                    </v-col>
                                    <v-col cols="12" md="3" style="margin-top:80px">
                                        <img
                                        width="100px"
                                        src="svg/saving-money.png"
                                        alt="Image"
                                        data-aos="fade-right"
                                    >
                                    </v-col>
                                    <v-col cols="12" md="9">
                                    <h4 style="color:rgba(248,217,75, 0.8); margin-top:80px">{{myJson.about_saving_money}}</h4>
                                        <span><br/>{{myJson.about_saving_money_desc_1}}
                                                <br/>{{myJson.about_saving_money_desc_2}}
                                                <br/>{{myJson.about_saving_money_desc_3}}</span>
                                    </v-col>
                                </v-row>
                        </v-col>
                        </v-row>
                    </v-row>      
                </v-container>
            </section>

            <section style="background-color:#1f2630" id="about"  v-if="!userId">
                <v-container>                   
                    <v-row justify="center" class="align-items-center">
                        <v-col style="margin-left:10%">
                            <img
                                        width="80%"
                                        src="svg/about.svg"
                                        alt="Image"
                                        data-aos="fade-right"
                                    />
                        </v-col>
                        <v-col cols="12" md="6" style="color:white">
                        <center><h3 style="margin-bottom:10px;color:rgba(248,217,75, 0.8)">{{myJson.about_us}}</h3></center> 
                                <v-row>  
                                    <span style="font-size:1em;margin-bottom:10px">
                                     {{myJson.about_us_desc}}</span>
                                </v-row>
                        </v-col>
                    </v-row>
                </v-container>

            </section>
            <!-- ======= Hero Section ======= -->
             <section style="background-color:#1f2630" id="company"  v-if="!userId">
                <v-container>                   
                    <v-row justify="center" class="align-items-center">      
                        <v-col cols="12" md="6" style="color:white">
                        <center><h3 style="margin-bottom:10px;color:rgba(248,217,75, 0.8)">{{myJson.about_company}}</h3></center> 
                                <v-row>  
                                    <v-col cols="12" md="6" style="margin-top:20px">  
                                        <ul style="margin-left:25%;color:white">
                                        <li><h5 style="color:white">{{myJson.about_company_1}}</h5>
                                        </li>                                        
                                        <li><h5 style="color:white">{{myJson.about_company_2}}</h5>
                                        </li>
                                        <li><h5 style="color:white">{{myJson.about_company_3}}</h5>
                                        </li>   
                                    </ul>  
                                    </v-col>
                                    <v-col cols="12" md="6" style="margin-top:20px">
                                        
                                        <ul style="margin-left:25%">
                                        <li><h5 style="color:white">{{myJson.about_company_4}}</h5>
                                        </li>
                                        <li><h5 style="color:white">{{myJson.about_company_5}}</h5>
                                        </li>
                                        <li><h5 style="color:white">{{myJson.about_company_6}}</h5>
                                        </li>
                                    </ul>        
                                    </v-col>
                                </v-row>
                        </v-col>
                        <v-col style="margin-left:10%;margin-bottom:20px">
                            <img
                                        width="60%"
                                        src="svg/company.svg"
                                        alt="Image"
                                        data-aos="fade-right"
                                    />
                        </v-col >

                        <v-row justify="center" class="align-items-center">
                        <v-row>
                        <center><h3 justify="center" class="align-items-center" style="color:rgba(248,217,75, 0.8);">Altex Timeline</h3>
                        </center>   
                            <v-col>
                            <center>
                                    <v-stepper value="7" style="background-color:#1f2630; color:white">
                                        <v-stepper-header>
                                        <v-stepper-step
                                            step="1"
                                            complete
                                        >
                                            <span style=" color:white">2015.05</span>
                                            <small style="color:rgba(248,217,75, 0.8)">{{myJson.about_timeline_1}}</small>
                                        </v-stepper-step>

                                        <v-divider></v-divider>

                                        <v-stepper-step step="2" complete>
                                            <span style=" color:white">2016.02</span>
                                            <small style="color:rgba(248,217,75, 0.8)">{{myJson.about_timeline_2}}</small>
                                        </v-stepper-step>
                                        <v-divider></v-divider>
                                        <v-stepper-step step="3" complete>
                                            <span style="color:white">2017.03</span>
                                            <small style="color:rgba(248,217,75, 0.8)">{{myJson.about_timeline_3}}</small>
                                        </v-stepper-step>
                                        <v-divider></v-divider>
                                        <v-stepper-step step="4" complete>
                                            <span style=" color:white">2018.02</span>
                                            <small style="color:rgba(248,217,75, 0.8)">{{myJson.about_timeline_4}}</small>
                                        </v-stepper-step>
                                        <v-divider></v-divider>
                                        <v-stepper-step step="5" complete>
                                            <span style=" color:white">2019.08</span>
                                            <small style="color:rgba(248,217,75, 0.8)">{{myJson.about_timeline_5}}</small>
                                        </v-stepper-step>
                                        <v-divider></v-divider>
                                        <v-stepper-step step="6" complete>
                                            <span style=" color:white">2020.12</span>
                                            <small style="color:rgba(248,217,75, 0.8)">{{myJson.about_timeline_6}}</small>
                                        </v-stepper-step>
                                        <v-divider></v-divider>
                                        <v-stepper-step step="7" complete>
                                           <span style=" color:white">2021.12</span>
                                           <small style="color:rgba(248,217,75, 0.8)">{{myJson.about_timeline_7}}</small>
                                        </v-stepper-step>
                                        </v-stepper-header>
                                    </v-stepper>
                            </center>
                                
                        </v-col>
                        
                        
                        </v-row>
                    
                        
                    </v-row>
                    </v-row>
                </v-container>
            </section>

            <section style="background-color:#1f2630" class="hero-section" id="team"  v-if="!userId">
                <v-container>
                    <v-row justify="center" class="align-items-center">
                        <v-row>
                        <center><h3 justify="center" class="align-items-center" style="color:rgba(248,217,75, 0.8)">{{myJson.meet_the_team}}</h3>
                        <br><span style="color:rgba(248,217,75, 0.8)">{{myJson.meet_the_team_founders}}</span></center>
                        <v-col ></v-col>
                        
                        <v-col >
                        <center>
                            <v-card
                                            
                                            max-width="240"
                                            max-height="0"
                                            color="#1f2630"
                                        >
                                            <v-img
                                            src="svg/1st.svg"
                                            height="20%"
                                            ></v-img>
                            </v-card>
                        </center>
                        </v-col>
                        <v-col  style="color:white; ">
                        <center>
                            <v-card
                                           max-width="240"
                                            max-height="0"
                                            color="#1f2630"
                                        >
                                            <v-img
                                            src="svg/2nd.svg"
                                            height="20%"
                                            ></v-img>
                            </v-card>
                        </center>      
                        </v-col>
                        <v-col >
                                <v-card
                                            class="mx-auto"
                                            max-width="240"
                                            max-height="0"
                                            color="#1f2630"
                                        >
                                            <v-img
                                            src="svg/3rd.svg"
                                            height="20%"
                                            ></v-img>
                            </v-card>
                        </v-col>
                        <v-col></v-col>
                        </v-row>
                        <v-row>
                        <v-col ></v-col>
                        </v-row>
                    </v-row>
                
                </v-container>

            </section>

            <section style="background-color:#1f2630" class="hero-section" id="team"  v-if="!userId">
                <v-container>
                    <v-row justify="center" class="align-items-center">
                        <v-row>
                        <center><h3 justify="center" class="align-items-center" style="color:rgba(248,217,75, 0.8)">{{myJson.meet_the_team}}</h3>
                        <br><span style="color:rgba(248,217,75, 0.8)">{{myJson.meet_the_team_developers}}</span></center>
                        <v-col cols="12" md="3">
                        <v-card
                                            class="mx-auto"
                                            max-width="240"
                                            max-height="0"
                                            color="#1f2630"
                                        >
                                            <v-img
                                            src="svg/4th.svg"
                                            height="20%"
                                            ></v-img>
                            </v-card>
                            </v-col>
                        <v-col cols="12" md="3">
                            <v-card
                                            class="mx-auto"
                                                max-width="240"
                                                max-height="0"
                                            color="#1f2630"
                                        >
                                            <v-img
                                            src="svg/5th.svg"
                                            height="20%"
                                            ></v-img>
                            </v-card>
                        </v-col>
                        <v-col  style="color:white; " cols="12" md="3">
                                <v-card
                                            class="mx-auto"
                                                max-width="240"
                                                max-height="0"
                                            color="#1f2630"
                                        >
                                            <v-img
                                            src="svg/6th.svg"
                                            height="20%"
                                            ></v-img>
                            </v-card>
                        </v-col>
                        <v-col cols="12" md="3">
                                <v-card
                                            class="mx-auto"
                                                max-width="240"
                                                max-height="0"
                                            color="#1f2630"
                                        >
                                            <v-img
                                            src="svg/7th.svg"
                                            height="20%"
                                            ></v-img>
                            </v-card>
                            </v-col>
                        </v-row>
                    </v-row>
                
                </v-container>

            </section>

            <section style="background-color:#1f2630" class="hero-section" id="agency"  v-if="!userId">
                <v-container>
                    <v-row justify="center" class="align-items-center">
                    
                        <v-row>

                        <center><h3 justify="center" class="align-items-center" style="color:rgba(248,217,75, 0.8)">{{myJson.cooperative_agency}}</h3>
                        </center>   
                        <v-col></v-col>
                            <v-col>
                            <center>
                                <img
                                        width="120%"
                                        src="svg/partner-md-a.png"
                                        alt="Image"
                                        data-aos="fade-right"
                                    />
                            </center>
                                
                        </v-col>
                        <v-col style="color:white; ">
                            <center>
                            <img
                                        width="120%"
                                        src="svg/partner-md-b.png"
                                        alt="Image"
                                        data-aos="fade-right"
                                    />   
                                    </center>
                              
                        </v-col>
                        <v-col>
                        <center>
                            <img
                                        width="120%"
                                        src="svg/partner-md-c.png"
                                        alt="Image"
                                        data-aos="fade-right"
                                    />
                        </center>
                                 
                        </v-col>

                        <v-col >
                            <center>
                                <img
                                        width="120%"
                                        src="svg/partner-md-d.png"
                                        alt="Image"
                                        data-aos="fade-right"
                                    />
                            </center>
                                 
                        </v-col>
                        <v-col cols="12" md="2">
                        <center>
                            <img
                                        width="120%"
                                        src="svg/partner-md-e.png"
                                        alt="Image"
                                        data-aos="fade-right"
                                    />
                        </center>
                                
                        </v-col>
                        <v-col cols="12" md="2">
                        <center>
                            <img
                                        width="200%"
                                        src="svg/logo-5th.svg"
                                        alt="Image"
                                        data-aos="fade-right"
                                    />
                        </center>
                                
                        </v-col>
                        </v-row>
                        

                         
                    </v-row>
                </v-container> 

                
            </section>

            <section style="background-color:#1f2630" class="hero-section" id="agency"  v-if="!userId">
                <v-container>
                    <v-row justify="center" class="align-items-center">         
                        <v-row>
                        <center><h3 justify="center" class="align-items-center" style="color:rgba(248,217,75, 0.8)" >{{myJson.advisory_body}}</h3>
                        <br></center>
                        
                        <v-col cols="12" md="2" style="color:white; ">
                        <center>
                            <img
                                        width="50%"
                                        src="svg/partner-sm-a.png"
                                        alt="Image"
                                        data-aos="fade-right"
                                    />   
                        </center>
                              
                        </v-col>
                        
                        
                        <v-col cols="12" md="2">
                        <center>
                            <img
                                        width="50%"
                                        src="svg/partner-sm-b.png"
                                        alt="Image"
                                        data-aos="fade-right"
                                    />
                        </center>
                                 
                        </v-col>

                        <v-col cols="12" md="2" lg="2">
                        <center>
                        <img
                                        width="50%"
                                        src="svg/partner-sm-c.png"
                                        alt="Image"
                                        data-aos="fade-right"
                                    />
                        </center>
                                 
                        </v-col>
                        <v-col cols="12" md="2">
                         <center>
                         <img
                                        width="50%"
                                        src="svg/partner-sm-d.png"
                                        alt="Image"
                                        data-aos="fade-right"
                                    />
                        </center>
                                
                        </v-col>
                        <v-col cols="12" md="2" style="color:white; ">
                        <center>
                            <img
                                        width="50%"
                                        src="svg/partner-xs-a.png"
                                        alt="Image"
                                        data-aos="fade-right"
                                    /> 
                        </center>
                                
                        </v-col>
                        <v-col cols="12" md="2">
                        <center>
                            <img
                                        width="50%"
                                        src="svg/partner-xs-b.png"
                                        alt="Image"
                                        data-aos="fade-right"
                                    />
                        </center>
                                 
                        </v-col>
                        <v-col cols="12" md="2">
                        
                        </v-col>

                        <v-col cols="12" md="2">
                            <center>
                                <img
                                        width="50%"
                                        src="svg/partner-xs-c.png"
                                        alt="Image"
                                        data-aos="fade-right"
                                    />
                            </center>
                                 
                        </v-col>
                        <v-col cols="12" md="2">
                        <center>
                                <img
                                        width="50%"
                                        src="svg/partner-xs-d.png"
                                        alt="Image"
                                        data-aos="fade-right"
                                    />
                                </center>
                        </v-col>
                        <v-col cols="12" md="2" style="color:white; ">
                        <center>
                            <img
                                        width="50%"
                                        src="svg/partner-xs-e.png"
                                        alt="Image"
                                        data-aos="fade-right"
                                    />
                        </center>
                        </v-col>
                        <v-col cols="12" md="2">
                        <center>
                            <img
                                        width="50%"
                                        src="svg/partner-xs-f.png"
                                        alt="Image"
                                        data-aos="fade-right"
                                    />
                        </center>
                                 
                        </v-col>
                        </v-row>

                    </v-row>
                </v-container> 

                
            </section>

            <v-footer style="background-color:#1f2630;" padless>
                <v-col
                class="text-center"
                style="color:white"
                >
                {{ new Date().getFullYear() }} — <strong style="color:white">Altex</strong>
                </v-col>
                <v-col cols="12" md="3">
                    <a @click="$router.push('privacy-policy')" style="color:rgba(248,217,75, 0.8)">{{myJson.privacy_policy}}</a>
                </v-col> 
                  
            </v-footer>

            

            

            

            
            <!-- ======= Hero Section ======= -->
            <!-- End Hero -->
            
            
        </div>
        <v-scale-transition>
            <v-btn
                fab
                v-show="fab"
                v-scroll="onScroll"
                dark
                fixed
                bottom
                right
                color="secondary"
                @click="toTop"
            >
                <v-icon>mdi-arrow-up</v-icon>
            </v-btn>
        </v-scale-transition>
    </v-app>
</template>

<script>

import enJson from './language/en.json'
import jpJson from './language/japan.json'
import spJson from './language/spanish.json'
import thaiJson from './language/thai.json'
import vietJson from './language/viet.json'



export default {
    name: "app",
    data() {
        return {
            fab: null,
            userId: sessionStorage.getItem("user-id"),
            color: "",
            flat: null,
            myJson: {},
        };
    },

    methods: {
        onScroll(e) {
            if (typeof window === "undefined") return;
            const top = window.pageYOffset || e.target.scrollTop || 0;
            this.fab = top > 60;
        },

        toTop() {
            this.$vuetify.goTo(0);
        },

        fetchHospitals() {
            this.hospitalsLatLng = [];
            axios
                .get("/api/v1/nearbyhospitals", {
                    params: {
                        lat: this.center.lat,
                        lng: this.center.lng
                    }
                })
                .then(response => {
                    this.hospitals = response.data.nearby;
                    let hospitals = response.data.nearby;
                    hospitals.forEach(hospital => {
                        var position = {
                            ...hospital,
                            lat: hospital.latitude,
                            lng: hospital.longitude
                        };
                        this.hospitalsLatLng.push(position);
                    });
                    console.log(this.hospitalsLatLng);
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => {
                    this.tableLoading = false;
                    this.componentOverlay = false;
                });
        },

        showHospital(id) {
            this.hospital = this.hospitals.find(x => x.id === id);
            console.log(this.hospital);
            this.hospitalDialog = true;
        },

        //Get Address to current location
        getUserGeolocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    this.setUserGeolocation
                );
            } else {
                window.clearInterval(window.locationInterval);
                alert("Geolocation is not supported by this browser.");
            }
        },

        //Set Address to current location
        setUserGeolocation(position) {
            var UserGeolocationLatitude = position.coords.latitude;
            var UserGeolocationLongitude = position.coords.longitude;
            this.center = {
                lat: UserGeolocationLatitude,
                lng: UserGeolocationLongitude
            };
            this.address = this.center;
        },

        chipColor(status) {
            if (status == "RECIEVING") {
                return "success";
            } else {
                return "red";
            }
        }
    },

    watch: {
        fab(value) {
            if (value) {
                this.color = "#f8f9fa";
                this.flat = false;
            } else {
                this.color = "transparent";
                this.flat = true;
            }
        }
    },

    created() {
        if(sessionStorage.getItem("language") == 'jp')
        {
            this.myJson = jpJson
        }
        else if(sessionStorage.getItem("language") == 'thai')
        {
            this.myJson = thaiJson
        }
        else if(sessionStorage.getItem("language") == 'spanish')
        {
            this.myJson = spJson
        }
        else if(sessionStorage.getItem("langauge") == 'vietnam')
        {
            this.myJson = vietJson
        }else
        {
            this.myJson = enJson
        }
    },
};
</script>
