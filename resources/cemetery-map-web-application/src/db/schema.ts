import { pgTable, serial, varchar, text, timestamp, integer, date } from 'drizzle-orm/pg-core';

// Tabel untuk blok/area kuburan
export const blocks = pgTable('blocks', {
  id: serial('id').primaryKey(),
  name: varchar('name', { length: 100 }).notNull(),
  description: text('description'),
  capacity: integer('capacity').notNull().default(0),
  createdAt: timestamp('created_at').defaultNow().notNull(),
});

// Tabel untuk makam individual
export const graves = pgTable('graves', {
  id: serial('id').primaryKey(),
  blockId: integer('block_id').notNull().references(() => blocks.id, { onDelete: 'cascade' }),
  plotNumber: varchar('plot_number', { length: 50 }).notNull(),
  row: integer('row').notNull(),
  column: integer('column').notNull(),
  status: varchar('status', { length: 20 }).notNull().default('available'), // available, occupied, reserved
  createdAt: timestamp('created_at').defaultNow().notNull(),
});

// Tabel untuk almarhum/almarhumah
export const deceased = pgTable('deceased', {
  id: serial('id').primaryKey(),
  graveId: integer('grave_id').notNull().references(() => graves.id, { onDelete: 'cascade' }),
  fullName: varchar('full_name', { length: 255 }).notNull(),
  birthDate: date('birth_date'),
  deathDate: date('death_date').notNull(),
  age: integer('age'),
  biography: text('biography'),
  photo: varchar('photo', { length: 500 }),
  createdAt: timestamp('created_at').defaultNow().notNull(),
  updatedAt: timestamp('updated_at').defaultNow().notNull(),
});

// Tabel untuk keluarga/contact person
export const relatives = pgTable('relatives', {
  id: serial('id').primaryKey(),
  deceasedId: integer('deceased_id').notNull().references(() => deceased.id, { onDelete: 'cascade' }),
  name: varchar('name', { length: 255 }).notNull(),
  relationship: varchar('relationship', { length: 100 }).notNull(),
  phone: varchar('phone', { length: 20 }),
  email: varchar('email', { length: 255 }),
  createdAt: timestamp('created_at').defaultNow().notNull(),
});
