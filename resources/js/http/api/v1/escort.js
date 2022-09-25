import Resource from '@/http/api/resource';

export default class EscortResource extends Resource {
  constructor() {
    super('/user/escort');
  }
}
