'use strict';

import React, { useState } from 'react';
import Layout from '../../Layout/Layout';
import { Board } from './Board/Board';

export default function SudokuIndex() {
  const [message, setMessage] = useState<string>('');
  const [messageVariant, setMessageVariant] = useState<string>('');

  return (
    <Layout>
      <div className='text-white'>
        <Board
          message={message}
          setMessage={setMessage}
          messageVariant={messageVariant}
          setMessageVariant={setMessageVariant}
        />
      </div>
    </Layout>
  );
}
