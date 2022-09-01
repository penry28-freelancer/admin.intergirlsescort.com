import Resource from '@/http/api/resource';

export default class ServiceResource extends Resource {
  constructor() {
    super('/escort/service');
  }
}
