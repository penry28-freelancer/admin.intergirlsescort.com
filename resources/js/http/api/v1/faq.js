import Resource from '@/http/api/resource';

export default class FaqResource extends Resource {
  constructor() {
    super('/utility/faq');
  }
}
