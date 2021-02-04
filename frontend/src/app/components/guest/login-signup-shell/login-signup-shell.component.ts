import { Component, ElementRef, ViewChild } from '@angular/core';

@Component({
  selector: 'app-login-signup-shell',
  templateUrl: './login-signup-shell.component.html',
  styleUrls: ['./login-signup-shell.component.scss']
})
export class LoginSignupShellComponent {

  public activeLink = "homeLink";

  constructor() { }

  @ViewChild( "drawer" ) drawer: ElementRef;
  // drawer links
  @ViewChild( "homeLink" )          homeLink         : ElementRef;
  @ViewChild( "storyLink" )         storyLink        : ElementRef;
  @ViewChild( "accountLink" )       accountLink      : ElementRef;
  @ViewChild( "gameRulesLink" )     gameRulesLink    : ElementRef;
  @ViewChild( "privacyPolicyLink" ) privacyPolicyLink: ElementRef;
  @ViewChild( "contactUsLink" )     contactUsLink    : ElementRef;

  openNav(): void {
    this.drawer.nativeElement.style.width = "175px";
  }

  closeNav(): void {
    this.drawer.nativeElement.style.width = "0";
  }

  setActiveLink( link:string ): void {
    this[this.activeLink].nativeElement.classList.remove( "active" );
    this.activeLink = link;
    this[link].nativeElement.classList.add( "active" );
  }


}
