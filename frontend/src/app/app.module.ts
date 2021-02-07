
import { BrowserModule }       from '@angular/platform-browser';
import { NgModule }            from '@angular/core';
import { HttpClientModule}     from "@angular/common/http";
import { ReactiveFormsModule } from '@angular/forms';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent }     from './app.component';

// login shell
import { LoginSignupShellComponent } from './components/guest/login-signup-shell/login-signup-shell.component';
import { SlideshowComponent }        from './components/guest/slideshow/slideshow.component';
import { FooterComponent }           from './components/guest/footer/footer.component';
import { StoryComponent }            from './components/guest/story/story.component';
import { AccountComponent }          from './components/guest/account/account.component';
import { GameRulesComponent }        from './components/guest/game-rules/game-rules.component';
import { PrivacyPolicyComponent }    from './components/guest/privacy-policy/privacy-policy.component';
import { ContactUsComponent }        from './components/guest/contact-us/contact-us.component';
import { HomeComponent }             from './components/guest/home/home.component';

// game shell
import { GameShellComponent }    from './components/game/game-shell/game-shell.component';
import { RegisterFormComponent } from './components/guest/register-form/register-form.component';

@NgModule({
  declarations: [
    AppComponent,
    SlideshowComponent,
    FooterComponent,
    LoginSignupShellComponent,
    GameShellComponent,
    StoryComponent,
    AccountComponent,
    GameRulesComponent,
    PrivacyPolicyComponent,
    ContactUsComponent,
    HomeComponent,
    RegisterFormComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    ReactiveFormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
