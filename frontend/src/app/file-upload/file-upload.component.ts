import { Component, ViewChild } from '@angular/core';
import { HttpClient, HttpEventType, HttpResponse, HttpErrorResponse } from '@angular/common/http';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { catchError } from 'rxjs/operators';
import { of } from 'rxjs';

@Component({
  selector: 'app-file-upload',
  templateUrl: './file-upload.component.html', // Use templateUrl with the path to the HTML file
  styleUrls: ['./file-upload.component.css'], // Optionally, include styleUrls for component-specific styles
})
export class FileUploadComponent {
  selectedProvider: string = 'DataProviderX';
  error: string = 'Something went wrong. Please try again later.';
  selectedFile: File | null = null;
  uploadProgress = 0;
  fileInputInvalid = false;

  @ViewChild('successModal') successModal: any;
  @ViewChild('errorModal') errorModal: any;

  constructor(private http: HttpClient, private modalService: NgbModal) {}

  onFileChange(event: any) {
    this.selectedFile = event.target.files[0];
  }

  onSubmitForm(form: any) {
    if (!this.selectedProvider || !this.selectedFile) {
      this.fileInputInvalid = true; // Set the flag for the custom alert
      return;
    }

    this.fileInputInvalid = false; // Reset the flag if inputs are valid

    const formData = new FormData();
    formData.append('provider', this.selectedProvider);
    formData.append('file', this.selectedFile as File);

    this.http.post('http://localhost/api/v1/import-data', formData, {
      reportProgress: true,
      observe: 'events',
    }).pipe(
      catchError((error: HttpErrorResponse) => {
        console.log(error);
        this.error = error.error.message ||error.message ;
        this.openModal(this.errorModal);
        return of(null); // Return an observable to continue the stream
      })
    ).subscribe((event: any) => {
      console.log('event', event);
      if (event.type === HttpEventType.UploadProgress) {
        if (event.total) {
          this.uploadProgress = Math.round((100 * event.loaded) / event.total);
        }
      } else if (event instanceof HttpResponse) {
        this.uploadProgress = 0;
        if (event.status === 200) {
          this.openModal(this.successModal);
        } else {
          this.error = event.statusText;
          this.openModal(this.errorModal);
        }
      }
    });
  }

  openModal(content: any) {
    this.modalService.open(content, { centered: true });
  }
}