import { Component, ElementRef, ViewChild } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {

  title = "Top Mafia";

  @ViewChild( "drawer" ) drawer: ElementRef;

  openNav() {
    this.drawer.nativeElement.style.width = "175px";
  }

  closeNav() {
    this.drawer.nativeElement.style.width = "0";
  }

}
