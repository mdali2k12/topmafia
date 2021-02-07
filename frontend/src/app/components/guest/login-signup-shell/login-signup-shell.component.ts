
import { Component, ElementRef, OnDestroy, OnInit, ViewChild } from '@angular/core';
import { Subscription }                                        from 'rxjs';

import { UsersService } from 'src/app/services/users.service';

@Component({
  selector: 'app-login-signup-shell',
  templateUrl: './login-signup-shell.component.html',
  styleUrls: ['./login-signup-shell.component.scss']
})
export class LoginSignupShellComponent implements OnInit, OnDestroy {

  $usersDataSub: Subscription;

  public activeLink         = "homeLink";
  public onlinePlayersCount = 0;
  public playersCount       = 0;

  @ViewChild( "drawer" ) drawer: ElementRef;
  // drawer links
  @ViewChild( "homeLink" )          homeLink         : ElementRef;
  @ViewChild( "storyLink" )         storyLink        : ElementRef;
  @ViewChild( "accountLink" )       accountLink      : ElementRef;
  @ViewChild( "gameRulesLink" )     gameRulesLink    : ElementRef;
  @ViewChild( "privacyPolicyLink" ) privacyPolicyLink: ElementRef;
  @ViewChild( "contactUsLink" )     contactUsLink    : ElementRef;
  @ViewChild( "registerLink" )      registerLink     : ElementRef;

  constructor( private _usersService: UsersService ) { }

  ngOnInit(): void {
    this.getUsersData();
  }

  ngOnDestroy(): void {
    this.$usersDataSub.unsubscribe();
  }

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

  getUsersData(): void {
    this.$usersDataSub = this._usersService.getUsersData()
      .subscribe( data => {
        this.onlinePlayersCount = data["onlinePlayersCount"] != undefined ? data["onlinePlayersCount"] : 0;
        this.playersCount       = data["playersCount"] != undefined ? data["playersCount"] : 0;
    });
  }

}
