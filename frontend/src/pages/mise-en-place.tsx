import BattleshipService from '@/api/battleship.service';
import { useEffect, useState } from 'react';
import { Ship } from '../type';
import styles from '@/styles/MiseEnPlace.module.css';
import { ShipView } from '@/composants/ShipView';

const MiseEnPlace = () => {
  const [ships, setShips] = useState<Ship[]>([]);

  useEffect(() => {
    async function fetchShips() {
      const ships = await BattleshipService.getShips();
      setShips(ships);
    }

    fetchShips();
  }, []);

  return (
    <div className={styles.container}>
      <h1>Mise en place</h1>
      {ships.map((ship) => {
        return <ShipView key={ship.key} ship={ship} />;
      })}
    </div>
  );
};

export default MiseEnPlace;
