<template>
    <v-app light>
        <v-toolbar fixed dark :class="$theme.header.right">
            <v-toolbar-title>{{ $base.name }}</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items class="hidden-sm-and-down">
                <v-btn class="active" @click="scroll('home')" flat>Home</v-btn>
                <v-btn @click="scroll('download')" flat>Download</v-btn>
                <v-btn :to="{ name: 'login' }" flat>Login</v-btn>
                <v-btn href="https://kitelos.mascodigo.com.bo" flat>About</v-btn>
            </v-toolbar-items>
        </v-toolbar>
        <v-content id="main">
            <section id="home">
                <v-parallax src="img/photos/road.jpg" height="750">
                    <v-layout column align-center justify-center class="white--text">
                        <img src="img/logo.svg" alt="Vuetify.js" height="200">
                        <h1 class="white--text mb-2 display-1 text-xs-center shadow-2 font-weight-bold">{{ $base.name }}</h1>
                        <div class="subheading mb-3 text-xs-center shadow-2">Powered by Laravel + Vue + Vuetify</div>
                        <v-btn :class="$theme.header.right" class="box-shadow" dark large @click="scroll('download')">
                            Get Started
                        </v-btn>
                    </v-layout>
                </v-parallax>
            </section>

            <section>
                <v-layout column wrap class="my-5" align-center>
                    <v-flex xs12 sm4 class="my-3">
                        <div class="text-xs-center">
                            <h2 class="headline">The best way to start developing</h2>
                            <span class="subheading">
                                forget about the schemes, start with the logic
                            </span>
                        </div>
                    </v-flex>
                    <v-flex xs12>
                        <v-container grid-list-xl>
                            <v-layout row wrap align-center>
                                <v-flex xs12 md4>
                                    <v-card class="elevation-0 transparent">
                                        <v-card-text class="text-xs-center">
                                            <svg class="icon icon-lg red--text text--darken-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M637.5 241.6c-4.2-4.8-62.8-78.1-73.1-90.5-10.3-12.4-15.4-10.2-21.7-9.3-6.4.9-80.5 13.4-89.1 14.8-8.6 1.5-14 4.9-8.7 12.3 4.7 6.6 53.4 75.7 64.2 90.9l-193.7 46.4L161.2 48.7c-6.1-9.1-7.4-12.3-21.4-11.6-14 .6-120.9 9.5-128.5 10.2-7.6.6-16 4-8.4 22s129 279.6 132.4 287.2c3.4 7.6 12.2 20 32.8 15 21.1-5.1 94.3-24.2 134.3-34.7 21.1 38.3 64.2 115.9 72.2 127 10.6 14.9 18 12.4 34.3 7.4 12.8-3.9 199.6-71.1 208-74.5 8.4-3.5 13.6-5.9 7.9-14.4-4.2-6.2-53.5-72.2-79.3-106.8 17.7-4.7 80.6-21.4 87.3-23.3 7.9-2 9-5.8 4.7-10.6zm-352.2 72c-2.3.5-110.8 26.5-116.6 27.8-5.8 1.3-5.8.7-6.5-1.3-.7-2-129-266.7-130.8-270-1.8-3.3-1.7-5.9 0-5.9s102.5-9 106-9.2c3.6-.2 3.2.6 4.5 2.8 0 0 142.2 245.4 144.6 249.7 2.6 4.3 1.1 5.6-1.2 6.1zm306 57.4c1.7 2.7 3.5 4.5-2 6.4-5.4 2-183.7 62.1-187.1 63.6-3.5 1.5-6.2 2-10.6-4.5s-62.4-106.8-62.4-106.8L518 280.6c4.7-1.5 6.2-2.5 9.2 2.2 2.9 4.8 62.4 85.5 64.1 88.2zm12.1-134.1c-4.2.9-73.6 18.1-73.6 18.1l-56.7-77.8c-1.6-2.3-2.9-4.5 1.1-5s68.4-12.2 71.3-12.8c2.9-.7 5.4-1.5 9 3.4 3.6 4.9 52.6 67 54.5 69.4 1.8 2.3-1.4 3.7-5.6 4.7z"/></svg>
                                        </v-card-text>
                                        <v-card-title primary-title class="layout justify-center">
                                            <div class="headline text-xs-center">Laravel Framework</div>
                                        </v-card-title>
                                        <v-card-text>
                                            Laravel is one of the easiest open source frameworks for PHP. It is simple, very powerful and has an elegant and fun interface to use. It was created in 2011 and has a great influence of frameworks such as Ruby on Rails, Sinatra and ASP.NET MVC.
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                                <v-flex xs12 md4>
                                    <v-card class="elevation-0 transparent">
                                        <v-card-text class="text-xs-center">
                                            <svg class="icon icon-lg teal--text text--darken-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M356.9 64.3H280l-56 88.6-48-88.6H0L224 448 448 64.3h-91.1zm-301.2 32h53.8L224 294.5 338.4 96.3h53.8L224 384.5 55.7 96.3z"/></svg>
                                        </v-card-text>
                                        <v-card-title primary-title class="layout justify-center">
                                            <div class="headline">Vue js</div>
                                        </v-card-title>
                                        <v-card-text>
                                            It is a progressive Framework, that is, it is a Framework that serves to consume user interface.
                                            It was created by Evan You who worked in Google making prototypes and in the core of the Meteor Framework, until he thought of another way to make an easier option that included the needs when making prototypes.
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                                <v-flex xs12 md4>
                                    <v-card class="elevation-0 transparent">
                                        <v-card-text class="text-xs-center">
                                            <svg class="icon icon-lg blue--text text--lighten-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M356.9 64.3H280l-56 88.6-48-88.6H0L224 448 448 64.3h-91.1zm-301.2 32h53.8L224 294.5 338.4 96.3h53.8L224 384.5 55.7 96.3z"/></svg>
                                        </v-card-text>
                                        <v-card-title primary-title class="layout justify-center">
                                            <div class="headline text-xs-center">Vuetify</div>
                                        </v-card-title>
                                        <v-card-text>
                                            Vuetify is a framework that combines the power of the popular VueJs with the aesthetics of Material Design. It allows to accelerate the development of complex web applications, incorporating a large number of "ready to use" components
                                        </v-card-text>
                                    </v-card> 
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-flex>
                </v-layout>
            </section>

            <section id="download">
                <v-layout row wrap class="my-5">
                    <v-flex xs10 offset-xs1>
                        <div class=fakeMenu>
                            <div class="fakeButtons fakeClose"></div>
                            <div class="fakeButtons fakeMinimize"></div>
                            <div class="fakeButtons fakeZoom"></div>
                        </div>
                        <div class="fakeScreen">
                            <p class="line1">$ composer create-project seguce92/mcpanel<span class="cursor1">_</span></p>
                            <p class="line2">$ yarn install or npm install<span class="cursor2">_</span></p>
                            <p class="line3">$ npm run dev<span class="cursor3">_</span></p>
                            <p class="line4">><span class="cursor4">_</span></p>
                        </div>
                    </v-flex>
                </v-layout>
            </section>

            <section id="started">
                <v-parallax src="img/photos/1.jpg" height="380">
                    <v-layout column align-center justify-center>
                        <div class="headline white--text mb-3 text-xs-center shadow-2">Web development has never been easier</div>
                        <em class="shadow-2">Kick-start your application today</em>
                        <v-btn class="mt-5 box-shadow" :class="$theme.header.right" dark large :to="{ name: 'login' }">
                            {{ $t('lang.msg.login') }}
                        </v-btn>
                    </v-layout>
                </v-parallax>
            </section>

            <section id="about">
                <v-container grid-list-xl>
                    <v-layout row wrap justify-center class="my-5">
                        <v-flex xs12 sm4>
                            <v-card class="elevation-0 transparent">
                                <v-card-title primary-title class="layout justify-center">
                                    <div class="headline">Company info</div>
                                </v-card-title>
                                <v-card-text>
                                    Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare. 
                                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
                                    Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti. 
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 sm4 offset-sm1>
                            <v-card class="elevation-0 transparent">
                                <v-card-title primary-title class="layout justify-center">
                                    <div class="headline">Contact us</div>
                                </v-card-title>
                                <v-card-text>
                                    Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                                </v-card-text>
                                <v-list class="transparent">
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-icon class="blue--text text--lighten-2">phone</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>+591 75720937</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-icon class="blue--text text--lighten-2">place</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>Potosí, BO</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-icon class="blue--text text--lighten-2">email</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>seguce92@gmail.com</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                </v-list>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
            </section>

            <v-footer class="blue-grey darken-4">
                <v-layout row wrap align-center>
                    <v-flex xs12>
                        <div class="white--text ml-3 text-xs-center">
                            <strong>&copy;KitElos</strong> 2019 <a target="_blank" href="https://sergiocruzes.com">seguce92</a>. Powered by <a href="https://laravel.com">Laravel</a> and <a href="https://vuejs.org">VueJS</a> and <a href="https://vuetifyjs.com">VuetifyJS</a> 
                        </div>
                    </v-flex>
                </v-layout>
            </v-footer>
        </v-content>
    </v-app>
</template>

<script>
export default {
    data: () => ({
        drawer: null,
        title: 'Your Logo'
    }),
    methods: {
        scroll: function (element) {
            this.$nextTick(() => {
                $('html, body').animate({
                    scrollTop: $("#" + element).offset().top - 100
                }, 2000)
            })
        }
    }
}
</script>

<style scoped>
    .icon {
        fill: currentColor;
        display: inline-block;
        height: 1em;
        font-size: inherit;
        vertical-align: middle;
        text-align: center;
    }

    .icon-lg {
        font-size: 3.8em!important;
    }
    .icon-1x {
        font-size: 1em!important;
    }
    .icon-1-2x {
        font-size: 1.2em!important;
    }

    .fakeButtons {
        height: 13px;
        width: 13px;
        border-radius: 50%;
        /*border: 1px solid #000;*/
        position: relative;
        top: 6px;
        left: 6px;
        background-color: #ff3b47;
        border-color: #9d252b;
        display: inline-block;
    }

    .fakeMinimize {
        left: 11px;
        background-color: #ffc100;
        border-color: #9d802c;
    }

    .fakeZoom {
        left: 16px;
        background-color: #00d742;
        border-color: #049931;
    }

    .fakeMenu {
        width: 90%;
        box-sizing: border-box;
        height: 25px;
        background-color: #bbbbbbb5;
        margin: 0 auto;
        border-top-right-radius: 5px;
        border-top-left-radius: 5px;
    }

    .fakeScreen {
        background-color: #052734;
        box-sizing: border-box;
        width: 90%;
        margin: 0 auto;
        padding: 20px;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
        max-height: 220px!important;
    }

    p {
        position: relative;
        text-align: left;
        font-size: 1.25em;
        font-family: monospace;
        white-space: normal;
        overflow: hidden;
        width: 0;
    }

    span {
        color: #ffffff;
        font-weight: bold;
    }

    .line1 {
        color: #9CD9F0;
        -webkit-animation: type 1s 1s steps(10, end) forwards;
        -moz-animation: type 1s 1s steps(10, end) forwards;
        -o-animation: type 1s 1s steps(10, end) forwards;
        animation: type 1s 1s steps(10, end) forwards;
    }

    .cursor1 {
        -webkit-animation: blink 1s 2s 2 forwards;
        -moz-animation: blink 1s 2s 2 forwards;
        -o-animation: blink 1s 2s 2 forwards;
        animation: blink 1s 2s 2 forwards;
    }

    .line2 {
        color: #CDEE69;
        -webkit-animation: type .5s 4.25s steps(20, end) forwards;
        -moz-animation: type .5s 4.25s steps(20, end) forwards;
        -o-animation: type .5s 4.25s steps(20, end) forwards;
        animation: type .5s 4.25s steps(20, end) forwards;
    }

    .cursor2 {
        -webkit-animation: blink 1s 5.25s 2 forwards;
        -moz-animation: blink 1s 5.25s 2 forwards;
        -o-animation: blink 1s 5.25s 2 forwards;
        animation: blink 1s 5.25s 2 forwards;
    }

    .line3 {
        color: #E09690;
        -webkit-animation: type .5s 7.5s steps(20, end) forwards;
        -moz-animation: type .5s 7.5s steps(20, end) forwards;
        -o-animation: type .5s 7.5s steps(20, end) forwards;
        animation: type .5s 7.5s steps(20, end) forwards;
    }

    .cursor3 {
        -webkit-animation: blink 1s 8.5s 2 forwards;
        -moz-animation: blink 1s 8.5s 2 forwards;
        -o-animation: blink 1s 8.5s 2 forwards;
        animation: blink 1s 8.5s 2 forwards;
    }

    .line4 {
        color: #fff;
        -webkit-animation: type .5s 10.75s steps(20, end) forwards;
        -moz-animation: type .5s 10.75s steps(20, end) forwards;
        -o-animation: type .5s 10.75s steps(20, end) forwards;
        animation: type .5s 10.75s steps(20, end) forwards;
    }

    .cursor4 {
        -webkit-animation: blink 1s 11.5s infinite;
        -moz-animation: blink 1s 8.5s infinite;
        -o-animation: blink 1s 8.5s infinite;
        animation: blink 1s 8.5s infinite;
    }

    @-webkit-keyframes blink {
        0% {
            opacity: 0;
        }
        40% {
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }

    @-moz-keyframes blink {
        0% {
            opacity: 0;
        }
        40% {
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }

    @-o-keyframes blink {
        0% {
            opacity: 0;
        }
        40% {
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }

    @keyframes blink {
        0% {
            opacity: 0;
        }
        40% {
            opacity: 0;
        }
        50% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }

    @-webkit-keyframes type {
        to {
            width: 100%;
        }
    }

    @-moz-keyframes type {
        to {
            width: 100%;
        }
    }

    @-o-keyframes type {
        to {
            width: 100%;
        }
    }

    @keyframes type {
        to {
            width: 100%;
        }
    }
    
</style>