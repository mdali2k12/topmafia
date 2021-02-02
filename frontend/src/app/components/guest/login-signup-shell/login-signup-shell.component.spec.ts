import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { LoginSignupShellComponent } from './login-signup-shell.component';

describe('LoginSignupShellComponent', () => {
  let component: LoginSignupShellComponent;
  let fixture: ComponentFixture<LoginSignupShellComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ LoginSignupShellComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(LoginSignupShellComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
