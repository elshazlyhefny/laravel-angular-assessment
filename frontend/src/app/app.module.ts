import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms'; // Import the FormsModule

import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';
import { AppRoutingModule } from './app-routing.module'; // Import the AppRoutingModule

import { AppComponent } from './app.component';
import { FileUploadComponent } from './file-upload/file-upload.component';
import { UserListComponent } from './user-list/user-list.component';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { WelcomeComponent } from './welcome/welcome.component';

@NgModule({
  declarations: [AppComponent, FileUploadComponent, UserListComponent, WelcomeComponent],
  imports: [FormsModule, BrowserModule, HttpClientModule, AppRoutingModule, NgbModule], // Add AppRoutingModule here
  providers: [],
  bootstrap: [AppComponent],
})
export class AppModule {}
