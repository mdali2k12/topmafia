import { Component, ElementRef, ViewChild } from '@angular/core';

@Component({
  selector: 'app-login-signup-shell',
  templateUrl: './login-signup-shell.component.html',
  styleUrls: ['./login-signup-shell.component.scss']
})
export class LoginSignupShellComponent {

  constructor() { }

  @ViewChild( "drawer" ) drawer: ElementRef;

  openNav() {
    this.drawer.nativeElement.style.width = "175px";
  }

  closeNav() {
    this.drawer.nativeElement.style.width = "0";
  }


}
