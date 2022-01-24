import React, { useState } from 'react';
import '../styles/calculator.scss';
import { InputGroup, InputGroupText, Input } from 'reactstrap';

export const Calculator = ({ product, material }) => {
  const { locale_quantity, locale_unit, calculation_type, locale_calculation_unit, proportion } = product;
  const [count, setCount] = useState(0);
  const [width, setWidth] = useState(0);
  const [height, setHeight] = useState(0);
  const [totalSum, setTotalSum] = useState(0);

  React.useEffect(() => {
    setCount((height * width) / 10000);
  }, [height, width])

  React.useEffect(() => {
    setTotalSum(Math.round(((material * count) / proportion) * 100) / 100);
  }, [count, material])

  return (
    <>
      <div className="calculator-wrapper">
        <p className="calculator-header">Калькулятор вартості товару</p>

        {
          calculation_type === 1 && (
              <>
                <InputGroup className="input-group">
                  <InputGroupText>Ширина маршу</InputGroupText>
                  <Input
                      type="number"
                      min="0"
                      value={width}
                      onChange={(event) => {
                        setWidth(event.target.value);
                      }}
                  />
                  <InputGroupText>{locale_calculation_unit}</InputGroupText>
                </InputGroup>

                <InputGroup className="input-group">
                  <InputGroupText>Довжина маршу</InputGroupText>
                  <Input
                      type="number"
                      min="0"
                      value={height}
                      onChange={(event) => {
                        setHeight(event.target.value);
                      }}
                  />
                  <InputGroupText>{locale_calculation_unit}</InputGroupText>
                </InputGroup>
              </>
          )
        }

        <InputGroup className="input-group">
          <InputGroupText>{locale_quantity}</InputGroupText>
          <Input
            type="number"
            min="0"
            value={count}
            onChange={(event) => {
              setCount(event.target.value);
            }}
          />
          <InputGroupText>{locale_unit}</InputGroupText>
        </InputGroup>

        <InputGroup>
          <InputGroupText className="input-total-sum">
            Загальна вартість:
          </InputGroupText>
          <InputGroupText className="form-control">{`${totalSum}грн`}</InputGroupText>
        </InputGroup>
      </div>
    </>
  );
};
