import Resource from '@/http/api/resource';
import request from '@/http/request';

export default class EscortResource extends Resource {
  constructor() {
    super('/user/escort');
  }

  storeGallery(resource) {
    return request({
      url: this.uri + '/gallery',
      method: 'POST',
      data: resource,
    });
  }

  storeRates(resource) {
    return request({
      url: this.uri + '/rates',
      method: 'POST',
      data: resource,
    });
  }

  storeService(resource) {
    return request({
      url: this.uri + '/services',
      method: 'POST',
      data: resource,
    });
  }

  storeWorkingTime(resource) {
    return request({
      url: this.uri + '/working-day',
      method: 'POST',
      data: resource,
    });
  }

   updateGallery(resource, id) {
    return request({
      url: this.uri + `/gallery/${id}`,
      method: 'PUT',
      data: resource,
    });
  }

  updateRates(resource, id) {
    return request({
      url: this.uri + `/rates/${id}`,
      method: 'PUT',
      data: resource,
    });
  }

  updateServices(resource, id) {
    return request({
      url: this.uri + `/services/${id}`,
      method: 'PUT',
      data: resource,
    });
  }

  updateWorkingDay(resource, id) {
    return request({
      url: this.uri + `/working-day/${id}`,
      method: 'PUT',
      data: resource,
    });
  }
}
