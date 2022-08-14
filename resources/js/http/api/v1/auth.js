import request from '@/http/request';

export default class AuthResource {
  constructor() {
    this.uri = '/auth';
  }

  login(resource) {
    return request({
      url: `${this.uri}/login`,
      method: 'POST',
      data: resource,
    });
  }

  verifyEmailResetPassword(resource) {
    return request({
      url: `${this.uri}/forgot-password`,
      method: 'POST',
      data: resource,
    });
  }

  resetPassword(resource) {
    return request({
      url: `${this.uri}/reset-password`,
      method: 'PATCH',
      data: resource,
    });
  }

  getUserAuth() {
    return request({
      url: `${this.uri}/user`,
      method: 'get',
    });
  }

  logout() {
    return request({
      url: `${this.uri}/logout`,
      method: 'post',
    });
  }
}
