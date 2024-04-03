import { Ship } from '@/type';
import { Card, CardBody, Text } from '@chakra-ui/react';

export const ShipView = ({ ship }: { ship: Ship }) => {
  return (
    <Card>
      <CardBody>
        <Text>{ship.name}</Text>
      </CardBody>
    </Card>
  );
};
