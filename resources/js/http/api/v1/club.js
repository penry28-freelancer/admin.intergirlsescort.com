import Resource from '@/http/api/resource';
import request from '@/http/request';

export default class ClubResource extends Resource {
  constructor() {
    super('/user/club');
  }
}
