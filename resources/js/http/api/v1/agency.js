import Resource from '@/http/api/resource';
import request from '@/http/request';

export default class AgencyResource extends Resource {
  constructor() {
    super('/user/agency');
  }
}
