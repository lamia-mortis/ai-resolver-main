'use strict';

import React from 'react';
import { Form, Button } from 'react-bootstrap';
import { usePage } from '@inertiajs/react';
import { IFlexibleConfigData } from '../../../interfaces/types';
import { createRenderableConfigName } from '../../../helpers/helpers';
import Layout from '../../Layout/Layout';

interface IRenderInput {
  (configKey: string, configValue: number | string | boolean, path: string, level: number): void;
}

export default function FlexibleConfigIndex() {
  const { flexible_config, flexibleConfigUpdateUrl } = usePage().props;
  const flexibleConfigTyped = flexible_config as IFlexibleConfigData;
  const flexibleConfigUpdateUrlTyped = flexibleConfigUpdateUrl as string;

  function handleFormSubmit(event) {
    event.preventDefault();
    const newData: IFlexibleConfigData | object = {};

    function generateNewFlexibleConfig(
      pathKeys: Array<string>,
      inputValue: number | string | boolean
    ) {
      let currentObject = newData;

      pathKeys.forEach((key: string, index: number) => {
        if (index === pathKeys.length - 1) {
          currentObject[key] = inputValue;
        } else {
          if (!(key in currentObject)) currentObject[key] = {};
          currentObject = currentObject[key];
        }
      });
    }

    for (const input of event.target.elements) {
      const value: number | string | boolean =
        input.type === 'checkbox' ? input.checked : input.value;
      const pathKeys: Array<string> = input.name.split('/').slice(1);
      generateNewFlexibleConfig(pathKeys, value);
    }
    axios.put(flexibleConfigUpdateUrlTyped, newData);
  }

  const inputComponents: Array<JSX.Element> = [];

  function renderInput(
    configKey: string,
    configValue: number | string | boolean,
    path: string,
    level: number
  ): void {
    const fullConfigPath: string = path + '/' + configKey;

    if (typeof configValue === 'boolean') {
      inputComponents.push(
        <Form.Group
          className={`text-light`}
          style={{ marginLeft: `${level}px` }}
          key={fullConfigPath}
        >
          <Form.Check
            className='text-light'
            type='checkbox'
            defaultChecked={configValue}
            name={fullConfigPath}
            label={createRenderableConfigName(configKey)}
          />
        </Form.Group>
      );
    }

    if (typeof configValue === 'string') {
      inputComponents.push(
        <Form.Group
          className={`text-light`}
          style={{ marginLeft: `${level}px` }}
          key={fullConfigPath}
        >
          <Form.Label className='text-light'>{createRenderableConfigName(configKey)}</Form.Label>
          <Form.Control
            className='text-light'
            type='text'
            defaultValue={configValue}
            name={fullConfigPath}
            label={createRenderableConfigName(configKey)}
          />
        </Form.Group>
      );
    }

    if (typeof configValue === 'number') {
      inputComponents.push(
        <Form.Group style={{ marginLeft: `${level}px` }} key={fullConfigPath}>
          <Form.Label>{createRenderableConfigName(configKey)}</Form.Label>
          <Form.Range
            type='range'
            min={1}
            max={9}
            name={fullConfigPath}
            defaultValue={configValue}
            label={createRenderableConfigName(configKey)}
          />
        </Form.Group>
      );
    }
  }

  function decomposeConfig(
    config: IFlexibleConfigData,
    fn: IRenderInput,
    path = '',
    level = 0
  ): void {
    const keys: Array<string> = Object.keys(config);
    // level of the object nesting
    level = level > 100 ? 100 : level;
    keys.forEach((key: string) => {
      if (typeof config[key] === 'object') {
        inputComponents.push(
          <div className={`text-light`} style={{ marginLeft: `${level}px` }} key={key}>
            {createRenderableConfigName(key)}
          </div>
        );

        return decomposeConfig(config[key], fn, path + '/' + key, level + 10);
      } else {
        return fn(key, config[key], path, level + 10);
      }
    });
  }
  decomposeConfig(flexibleConfigTyped, renderInput);

  return (
    <>
      {inputComponents && (
        <Layout>
          <Form id='flexible-config-form' onSubmit={handleFormSubmit}>
            {inputComponents}
            <Button type='submit'>Submit</Button>
          </Form>
        </Layout>
      )}
    </>
  );
}
