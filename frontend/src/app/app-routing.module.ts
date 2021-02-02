
import { NgModule } from '@angular/core';

import { Routes, RouterModule } from '@angular/router';

import { AuthGuard }            from './auth/auth.guard';
import { GuestGuard }           from './auth/guest.guard';

import { GameShellComponent }        from './components/game/game-shell/game-shell.component';
import { LoginSignupShellComponent } from './components/guest/login-signup-shell/login-signup-shell.component';


const routes: Routes = [
  {
    path       : "auth",
    component  : LoginSignupShellComponent,
    canActivate: [GuestGuard]
  },
  {
    path       : "game",
    component  : GameShellComponent,
    canActivate: [AuthGuard]
  },
  {
    path       : "",
    redirectTo : "/game",
    pathMatch  : "full"
  }
];

@NgModule({
  imports  : [RouterModule.forRoot(routes)],
  exports  : [RouterModule],
  providers: [AuthGuard]
})
export class AppRoutingModule { }
