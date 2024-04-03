import axios from 'axios';
import { Ship } from '../type';

export default class BattleshipService {
  static getShips(): Promise<Ship[]> {
    return axios
      .get('api/reference/ships')
      .then((resp) => {
        return resp.data;
      })
      .catch((e) => Promise.reject(e));
  }
}
