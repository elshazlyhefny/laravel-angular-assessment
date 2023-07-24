// api.service.ts
import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root',
})
export class ApiService {
  private apiUrl = 'http://localhost/api/v1';

  constructor(private http: HttpClient) {}

  uploadFiles(files: File[]) {
    const formData: FormData = new FormData();
    files.forEach((file) => {
      formData.append('files[]', file, file.name);
    });

    return this.http.post<any>(`${this.apiUrl}/import-data`, formData);
  }

}
