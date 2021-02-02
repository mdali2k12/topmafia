
import { BrowserModule } from '@angular/platform-browser';
import { NgModule }      from '@angular/core';

import { AppRoutingModule }          from './app-routing.module';
import { AppComponent }              from './app.component';

// login shell
import { LoginSignupShellComponent } from './components/guest/login-signup-shell/login-signup-shell.component';
import { SlideshowComponent }        from './components/guest/slideshow/slideshow.component';
import { FooterComponent }           from './components/guest/footer/footer.component';
import { GameShellComponent } from './components/game/game-shell/game-shell.component';

@NgModule({
  declarations: [
    AppComponent,
    SlideshowComponent,
    FooterComponent,
    LoginSignupShellComponent,
    GameShellComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
